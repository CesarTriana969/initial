<?php

namespace App\Http\Controllers;

use App\Actions\Panel\SiteServices\Interfaces\SiteServicesInterface;
use App\Models\File;
use App\Models\ServiceFaq;
use App\Models\SiteService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteServiceController extends Controller
{
    protected $siteServiceInterface;

    public function __construct(SiteServicesInterface $siteServiceInterface)
    {
        $this->siteServiceInterface = $siteServiceInterface;

        $this->middleware('permission:view-content-services', ['only'=>['index','services']]);
        $this->middleware('permission:create-content-services', ['only'=>['store']]);
        $this->middleware('permission:edit-content-services', ['only'=>['edit','update', 'storeFaq']]);
        $this->middleware('permission:delete-content-service', ['only'=>['delete', 'destroy']]);
    }

    public function index(): renderable
    {
        return view('admin.site-services.index');
    }

    public function services(Request $request): JsonResponse
    {
        return $this->siteServiceInterface->services($request);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->siteServiceInterface->store($request);
    }

    public function storeGalleryFile(Request $request, SiteService $service)
    {
        return $this->siteServiceInterface->storeGalleryFile($service, $request);
    }

    public function updateGalleryFile(Request $request, File $file)
    {
        return $this->siteServiceInterface->updateGalleryFile($request, $file);
    }

    public function deleteGalleryFile(File $file)
    {
        return $this->siteServiceInterface->deleteGalleryFile($file);
    }

    public function edit($siteService)
    {
        return $this->siteServiceInterface->edit($siteService);
    }   

    public function update(Request $request, $id)
    {
        return $this->siteServiceInterface->update($request, $id);
    }

    public function storeFaq(Request $request): JsonResponse
    {
        return $this->siteServiceInterface->storeFaq($request);
    }

    public function delete(ServiceFaq $faq): JsonResponse
    {
       return $this->siteServiceInterface->delete($faq);
    }

    public function destroy(Request $request): JsonResponse
    {
        return $this->siteServiceInterface->destroy($request);
    }

    public function updateStatus(Request $request, SiteService $service): JsonResponse
    {
        return $this->siteServiceInterface->updateStatus($request, $service);
    }

    public function updateQuote(Request $request, SiteService $service): JsonResponse
    {
        return $this->siteServiceInterface->updateQuote($request, $service);
    }
}
