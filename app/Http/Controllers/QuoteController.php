<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\PolymorphicMetadata;
use App\Models\Quote;
use App\Models\QuoteRequest;
use App\Models\QuoteSiteService;
use App\Models\SiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuoteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search = $request->search;
        $quotes = Quote::where(function ($query) use ($search) {
            $query->where('id', 'LIKE', '%'.$search.'%')
                  ->orWhere('name', 'LIKE', '%'.$search.'%');
            })->orderBy('id', 'desc')
            ->paginate();
    
        return response()->json($quotes);
    }

    public function edit(SiteService $service, Quote $quote)
    {
        $pivotData = $quote->siteServices()->where('site_service_id', $service->id)->first();
        $metadata = QuoteSiteService::with(['metadatable', 'files.metadatas'])->find($pivotData->pivot->id);

        if ($pivotData) {
            $responseData = [
                'quote_name' => $quote->name,
                'id' => $pivotData->pivot->id,
                'site_service_id' => $pivotData->pivot->site_service_id,
                'quote_id' => $pivotData->pivot->quote_id,
                'metadata' => $metadata->metadatable,
                'files' => $metadata->files
            ];
    
            return response()->json($responseData);
        }
        return response()->json(['message' => 'Relación no encontrada'], 404);
    }
    
    public function store(Request  $request): JsonResponse
    {
        $faq = Quote::create(['name' => $request->name]);
        return response()->json($faq);
    }

    public function update(Request $request, QuoteSiteService $quoteService)
    {
        $quote = Quote::find($request->quote_id);
        $quote->update(['name' => $request->name]);

        $metadataMappings = [
            'value' => $request->value,
            'min' => $request->min,
            'max' => $request->max,
            'slug' => $request->slug,
            'promotion_type' => $request->promotion_type,
            'promo' => $request->promo,
        ];

        foreach ($metadataMappings as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            $quoteService->metadatable()->updateOrCreate(
                ['meta_key' => $key],
                ['meta_value' => $value]
            );
        }
        return response()->json($quoteService);
    }

    public function storeTextureGalleryFile($quoteSiteService, Request $request)
    {
        $quoteSiteService = QuoteSiteService::find($quoteSiteService);
        $value = $request->file('gallery_file');
        $extension = $value->getClientOriginalExtension();
        
        $fileName = Str::slug($request->slug) . '.' . $extension;
        $cardFilePath = $value->storeAs('quotes', $fileName);

        $cardFileModel = new File();
        if($request->type == 'color'){
            $cardFileModel->file_key = 'color_file';
        }else{
            $cardFileModel->file_key = 'texture_file';
        }
        $cardFileModel->file_path = $cardFilePath;
        $quoteSiteService->files()->save($cardFileModel);

        $metadataMappings = [
            'name' => $request->name,
            'slug' => $request->slug,
            'alt_attribute' => $request->alt_attribute,
        ];

        foreach ($metadataMappings as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            $cardFileModel->metadatas()->create([
                'meta_key' => $key,
                'meta_value' => $value
            ]);
        }

        return response()->json($quoteSiteService);
    }

    public function updateTextureGalleryFile(Request $request, File $file)
    {
        $originalFilePath = $file->file_without_domain;

        if ($request->hasFile('gallery_file')) {
            $value = $request->file('gallery_file');
            $extension = $value->getClientOriginalExtension();
            $newFileName = Str::slug($request->slug) . '.' . $extension;
            $newFilePath = $value->storeAs('quotes', $newFileName);
        } elseif ($request->has('slug')) {
            $extension = pathinfo($originalFilePath, PATHINFO_EXTENSION);
            $newFileName = Str::slug($request->slug) . '.' . $extension;
            $newFilePath = 'quotes/' . $newFileName;

            if ($originalFilePath !== $newFilePath) {
                 Storage::move($originalFilePath, $newFilePath);
            }
        } else {
            $newFilePath = $originalFilePath;
        }

        $file->file_path = $newFilePath;
        $file->save();
    
        $metadataMappings = [
            'name' => $request->name,
            'slug' => $request->slug,
            'alt_attribute' => $request->alt_attribute,
        ];
    
        foreach ($metadataMappings as $key => $value) {
            if (is_null($value)) {
                continue;
            }
    
            $metadata = $file->metadatas()->updateOrCreate(
                ['meta_key' => $key],
                ['meta_value' => $value]
            );
        }
    
        return response()->json($file->load('metadatas'));
    }

    public function quoteRequest(){
        return view('admin.quote-request.index');
    }

    public function getquoteRequest(Request $request): JsonResponse
    {
        $search = $request->search;
        $quotes = QuoteRequest::where(function ($query) use ($search) {
            $query->where('id', 'LIKE', '%'.$search.'%')
                  ->orWhere('name', 'LIKE', '%'.$search.'%')
                  ->orWhere('email', 'LIKE', '%'.$search.'%')
                  ->orWhere('phone', 'LIKE', '%'.$search.'%')
                  ->orWhere('service', 'LIKE', '%'.$search.'%');
            })->orderBy('id', 'desc')
            ->paginate();

        return response()->json($quotes);
    }

    
    public function editQuoteRequest(QuoteRequest $quoteRequest)
    {
        $texture = File::with('metadatas')->find($quoteRequest->texture);
        $color = File::with('metadatas')->find($quoteRequest->color);
        $textureMetadatas = json_encode($this->prepareMetadatas($texture->metadatas));
        $colorMetadatas = json_encode($this->prepareMetadatas($color->metadatas));
        return view('admin.quote-request.edit', compact('quoteRequest', 'texture', 'textureMetadatas', 'color', 'colorMetadatas'));
    }

    private function prepareMetadatas($metadatas)
    {
        $preparedMetadatas = [];

        foreach ($metadatas as $metadata) {
            $preparedMetadatas[$metadata->meta_key] = $metadata->meta_value;
        }

        return $preparedMetadatas;
    }

    public function updateQuoteRequest(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'specification' => 'required',
            'service' => 'required',
            'range' => 'required',
            'patio_size'  => 'required',
            'unit_price'  => 'required',
            'discount'  => 'required',
            'normal_price'  => 'required',
            'total'  => 'required',
        ]);
        $quoteRequest->fill($request->all());
        $quoteRequest->save();
        return response()->json(['message' => 'Request Quote updated successfully']);
    }

    public function updateStatus(Request $request, QuoteRequest $quoteRequest): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|boolean',
            ]);

            $quoteRequest->status = $validatedData['status'];
            $quoteRequest->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }
}
