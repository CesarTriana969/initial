<?php

namespace App\Actions\Panel\SiteServices\ServiceArea\Interfaces;

use App\Models\ServiceCounty;

interface ServiceAreaInterface
{
    public function serviceAreas($request);
    public function store($request);
    public function edit($serviceArea);
    public function update($request, $id);
    public function storeCounty($request);
    public function delete(ServiceCounty $county);
    public function destroy($request);
}
