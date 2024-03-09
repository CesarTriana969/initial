<?php

namespace App\Actions\Panel\SiteServices\Interfaces;

use App\Models\File;
use App\Models\ServiceFaq;
use App\Models\SiteService;

interface SiteServicesInterface
{
    public function services($request);
    public function store($request);
    public function storeGalleryFile(SiteService $siteService, $request);
    public function updateGalleryFile($request, File $file);
    public function deleteGalleryFile(File $file);
    public function edit($siteService);
    public function update($request, $id);
    public function storeFaq($request);
    public function delete(ServiceFaq $faq);
    public function destroy($request);
    public function updateStatus($request, SiteService $service);
    public function updateQuote($request, SiteService $service);
}
