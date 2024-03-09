<?php

namespace App\Actions\Panel\SiteServices;

use App\Actions\Panel\SiteServices\Interfaces\SiteServicesInterface;
use App\Models\File;
use App\Models\ServiceFaq;
use App\Models\SiteService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteServicesAction implements SiteServicesInterface
{
    public function services($request): JsonResponse
    {
        $search = $request->search;
        $parentId = $request->parent_id;
    
        $query = SiteService::query();
    
        if (isset($parentId)) {
            $query->where('parent_id', $parentId);
        } else {
            $query->whereNull('parent_id');
        }
    
        $query->where(function ($query) use ($search) {
            $query->where('id', 'LIKE', '%'.$search.'%')
                  ->orWhere('title', 'LIKE', '%'.$search.'%')
                  ->orWhere('subtitle', 'LIKE', '%'.$search.'%');
        });
    
        $blogs = $query->orderBy('id', 'desc')->paginate();
    
        return response()->json($blogs);
    }

    public function store($request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string|max:255|unique:site_services',
            'path_service_home' => 'nullable|image|max:2048', 
            'alt_attribute' => 'nullable|string|max:255',
            'path_icon' => 'nullable|image|max:2048', 
            'alt_attribute_icon' => 'nullable|string|max:255', 
            'slug_service_home' => 'required|string|max:255|unique:polymorphic_metadata,meta_value',
            'slug_icon' => 'required|string|max:255|unique:polymorphic_metadata,meta_value',
            'slug_faqs_image' => 'required|string|max:255|unique:polymorphic_metadata,meta_value',
        ]);
        $siteService = new SiteService;
        $siteService->fill($request->all());
        $siteService->save();

        $metadataMappings = [
            'path_service_home' => $request->file('path_service_home'),
            'path_icon' => $request->file('path_icon'),
            'path_faqs_image' => $request->file('path_faqs_image'),
            'alt_attribute' => $request->alt_attribute,
            'alt_attribute_icon' => $request->alt_attribute_icon,
            'alt_attribute_faqs_image' => $request->alt_attribute_faqs_image,
            'description' => $request->description,
            'card_description' => $request->card_description,
            'slug_service_home' => $request->slug_service_home,
            'slug_icon' => $request->slug_icon,
            'slug_faqs_image' => $request->slug_faqs_image,
        ];

        $filePaths = [];

        foreach ($metadataMappings as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            if ($key === 'path_service_home' || $key === 'path_icon' || $key === 'path_faqs_image') {
                $filePaths = [];
                $extension = $value->getClientOriginalExtension();
                if ($key === 'path_service_home') {
                    $fileName = Str::slug($request->slug_service_home) . '.' . $extension;
                } elseif ($key === 'path_icon') {
                    $fileName = Str::slug($request->slug_icon) . '.' . $extension;
                } elseif ($key === 'path_faqs_image') {
                    $fileName = Str::slug($request->slug_faqs_image) . '.' . $extension;
                } else {
                    $fileName = $value->getClientOriginalName();
                }                
                
                $cardFilePath = $value->storeAs('services', $fileName);
                $metadata = $siteService->metadata()->create([
                    'meta_key' => $key,
                    'meta_value' => $key 
                ]);

                $cardFileModel = new File();
                $cardFileModel->file_key = $key;
                $cardFileModel->file_path = $cardFilePath;
                $metadata->files()->save($cardFileModel);

                $filePaths[] = $cardFilePath;
            }else{
                $siteService->metadata()->create([
                    'meta_key' => $key,
                    'meta_value' => $value
                ]);
            }
        }

        return response()->json(['message' => 'SiteService created successfully']);
    }

    public function storeGalleryFile(SiteService $siteService, $request)
    {
        $request->validate([
            'alt_attribute' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:polymorphic_metadata,meta_value',
        ]);

        $value = $request->file('gallery_file');
        $extension = $value->getClientOriginalExtension();
        
        $fileName = Str::slug($request->slug) . '.' . $extension;
        $cardFilePath = $value->storeAs('services', $fileName);

        $cardFileModel = new File();
        $cardFileModel->file_key = 'gallery_file';
        $cardFileModel->file_path = $cardFilePath;
        $siteService->files()->save($cardFileModel);

        $metadataMappings = [
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

        return response()->json($siteService);
    }

    public function updateGalleryFile($request, File $file)
    {
        $originalFilePath = $file->file_without_domain;

        if ($request->hasFile('gallery_file')) {
            $value = $request->file('gallery_file');
            $extension = $value->getClientOriginalExtension();
            $newFileName = Str::slug($request->slug) . '.' . $extension;
            $newFilePath = $value->storeAs('services', $newFileName);
        } elseif ($request->has('slug')) {
            $extension = pathinfo($originalFilePath, PATHINFO_EXTENSION);
            $newFileName = Str::slug($request->slug) . '.' . $extension;
            $newFilePath = 'services/' . $newFileName;

            if ($originalFilePath !== $newFilePath) {
                 Storage::move($originalFilePath, $newFilePath);
            }
        } else {
            $newFilePath = $originalFilePath;
        }

        $file->file_path = $newFilePath;
        $file->save();
    
        $metadataMappings = [
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

    public function deleteGalleryFile(File $file)
    {
        if (Storage::exists($file->file_without_domain)) {
            Storage::delete($file->file_without_domain);
        }

        foreach ($file->metadatas as $metadata) {
            $metadata->delete();
        }

        $file->delete();

        return response()->json(['message' => 'Archivo eliminado con éxito.']);
    }

    public function edit($siteService): Renderable
    {
        $siteService = SiteService::with(['faqs', 'metadata.files', 'files.metadatas'])->find($siteService);
        return view('admin.site-services.edit', compact('siteService'));
    }

    public function update($request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string|max:255|unique:site_services,slug,' . $id,
            'path_service_home' => 'nullable|image|max:2048', 
            'alt_attribute' => 'nullable|string|max:255',
            'path_icon' => 'nullable|image|max:2048', 
            'alt_attribute_icon' => 'nullable|string|max:255', 
            'slug_service_home' => 'required|string|max:255|unique:polymorphic_metadata,meta_value,' . $id . ',metable_id',
            'slug_icon' => 'required|string|max:255|unique:polymorphic_metadata,meta_value,' . $id . ',metable_id',
            'slug_faqs_image' => 'required|string|max:255|unique:polymorphic_metadata,meta_value,' . $id . ',metable_id',
            'slug_about_us_image' => 'required|string|max:255|unique:polymorphic_metadata,meta_value,' . $id . ',metable_id',
            'slug_contact_us_image' => 'required|string|max:255|unique:polymorphic_metadata,meta_value,' . $id . ',metable_id',
        ]);
    
        $siteService = SiteService::findOrFail($id);
        $siteService->fill($request->all());
        $siteService->save();
    
        $metadataMappings = [
            'card_description' => $request->card_description,
            'description' => $request->description,

            'faq_title' => $request->faq_title,
            'faq_description' => $request->faq_description,

            'about_us_title' => $request->about_us_title,
            'about_us_description' => $request->about_us_description,

            'path_service_home' => $request->file('path_service_home'),
            'path_icon' => $request->file('path_icon'),
            'path_faqs_image' => $request->file('path_faqs_image'),
            'path_about_us_image' => $request->file('path_about_us_image'),
            'path_contact_us_image' => $request->file('path_contact_us_image'),

            'alt_attribute' => $request->alt_attribute,
            'alt_attribute_icon' => $request->alt_attribute_icon,
            'alt_attribute_faqs_image' => $request->alt_attribute_faqs_image,
            'alt_attribute_about_us_image' => $request->alt_attribute_about_us_image,
            'alt_attribute_contact_us_image' => $request->alt_attribute_contact_us_image,

            'slug_service_home' => $request->slug_service_home,
            'slug_icon' => $request->slug_icon,
            'slug_faqs_image' => $request->slug_faqs_image,
            'slug_about_us_image' => $request->slug_about_us_image,
            'slug_contact_us_image' => $request->slug_contact_us_image,
        ];

        $filePaths = [];

        foreach ($metadataMappings as $key => $value) {
            if (is_null($value)) {
                continue;
            }
    
            if (in_array($key, ['path_service_home', 'path_icon', 'path_faqs_image', 'path_about_us_image', 'path_contact_us_image'])) {
                $filePaths = $this->handleFileUpdate($request, $siteService, $key, $value);
            } else {
                $this->handleMetadataUpdate($siteService, $key, $value);
            }
        }

        return response()->json(['message' => 'SiteService updated successfully']);
    }

    private function handleFileUpdate($request, $siteService, $key, $file) {
        $extension = $file->getClientOriginalExtension();
        $fileName = $this->determineFileName($request, $key, $file, $extension);
    
        $cardFilePath = $file->storeAs('services', $fileName);
    
        $metadata = $siteService->metadata()->updateOrCreate(
            ['meta_key' => $key],
            ['meta_value' => $cardFilePath]
        );
    
        $cardFileModel = File::updateOrCreate(
            ['file_key' => $key, 'fileable_id' => $metadata->id, 'fileable_type' => 'App\Models\PolymorphicMetadata'],
            ['file_path' => $cardFilePath]
        );
        
    
        return $cardFilePath;
    }
    
    private function handleMetadataUpdate($siteService, $key, $value) {
        $siteService->metadata()->updateOrCreate(
            ['meta_key' => $key],
            ['meta_value' => $value]
        );
    }
    
    private function determineFileName($request, $key, $file, $extension) {
        switch ($key) {
            case 'path_service_home':
                return Str::slug($request->slug_service_home) . '.' . $extension;
            case 'path_icon':
                return Str::slug($request->slug_icon) . '.' . $extension;
            case 'path_faqs_image':
                return Str::slug($request->slug_faqs_image) . '.' . $extension;
            case 'path_about_us_image':
                return Str::slug($request->slug_about_us_image) . '.' . $extension;
            case 'path_contact_us_image':
                return Str::slug($request->slug_contact_us_image) . '.' . $extension;
            default:
                return $file->getClientOriginalName();
        }
    }

    public function storeFaq($request): JsonResponse
    {
        $faq = ServiceFaq::create(
            [
                'site_service_id' => $request->service_id,
                'faq' => $request->faq,
                'answer' => $request->answer,
                'column_number' => $request->column,
            ]
        );

        return response()->json($faq);
    }

    public function delete(ServiceFaq $faq): JsonResponse
    {
        if ($faq) {
            $faq->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Category not found'], 404);
    }

    public function destroy($request): JsonResponse
    {
        $site_services = json_decode($request->site_services);
        
        foreach($site_services as $site_service){
            SiteService::find($site_service)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }

    public function updateStatus($request, SiteService $service): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|boolean',
            ]);

            $service->status = $validatedData['status'];
            $service->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }

    public function updateQuote($request, SiteService $service): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'quote' => 'required|boolean',
            ]);

            $service->quote = $validatedData['quote'];
            $service->save();

            return response()->json(['success' => true, 'message' => 'Quote updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating Quote: ' . $e->getMessage()], 500);
        }
    }

}
