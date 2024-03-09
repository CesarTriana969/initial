<?php
namespace App\Http\Controllers;

use App\Actions\Panel\SiteServices\ServiceArea\Interfaces\ServiceAreaInterface;
use App\Models\ServiceCounty;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceStateController extends Controller
{
    protected $serviceAreaInterface;

    public function __construct(ServiceAreaInterface $serviceAreaInterface)
    {
        $this->serviceAreaInterface = $serviceAreaInterface;

        $this->middleware('permission:view-content-services', ['only'=>['index','serviceAreas']]);
        $this->middleware('permission:create-content-services', ['only'=>['store']]);
        $this->middleware('permission:edit-content-services', ['only'=>['edit','update']]);
        $this->middleware('permission:delete-content-service', ['only'=>['delete', 'destroy']]);
    }

    public function index(): Renderable
    {
        return view('admin.service-areas.index');
    }

    public function serviceAreas(Request $request): JsonResponse
    {
       return $this->serviceAreaInterface->serviceAreas($request);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->serviceAreaInterface->store($request);
    }

 
    public function edit($serviceArea): Renderable
    {
        return $this->serviceAreaInterface->edit($serviceArea);
    }

    public function update(Request $request, $id): JsonResponse
    {
        return $this->serviceAreaInterface->update($request, $id);
    }

    public function storeCounty(Request $request): JsonResponse
    {
        return $this->serviceAreaInterface->storeCounty($request);
    }

    public function delete(ServiceCounty $county): JsonResponse
    {
        return $this->serviceAreaInterface->delete($county);
    }

    public function destroy(Request $request)
    {
        return $this->serviceAreaInterface->destroy($request);
    }
}
