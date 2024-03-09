<?php

namespace App\Actions\Panel\SiteServices\ServiceArea;

use App\Actions\Panel\SiteServices\ServiceArea\Interfaces\ServiceAreaInterface;
use App\Models\ServiceCounty;
use App\Models\ServiceState;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

// ... other imports ...

class ServiceAreaAction implements ServiceAreaInterface
{
    public function serviceAreas($request): JsonResponse
    {
        $search = $request->search;
        $blogs = ServiceState::where('id', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();

        return response()->json($blogs);
    }

    public function store($request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abv' => 'required|string|max:10',
            'slug' => 'required|string|max:255|unique:service_states',
        ]);

        $serviceAreas = new ServiceState();
        $serviceAreas->fill($request->all());
        $serviceAreas->save();

        return response()->json(['message' => 'SiteService created successfully']);
    }

    public function edit($serviceArea): Renderable
    {
        $serviceArea = ServiceState::with(['counties'])->find($serviceArea);
        return view('admin.service-areas.edit', compact('serviceArea'));
    }

    public function update($request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abv' => 'required|string|max:10',
            'slug' => 'required|string|max:255|unique:service_states,slug,' . $id
        ]);
        $siteService = ServiceState::findOrFail($id);
        $siteService->fill($request->all());
        $siteService->save();
        return response()->json(['message' => 'Service Area updated successfully']);
    }

    
    public function storeCounty($request): JsonResponse
    {
       ServiceCounty::create(
            [
                'name' => $request->name,
                'slug' => $request->slug,
                'service_state_id' => $request->service_state_id,
            ]
        );

        return response()->json(['message' => 'County saved successfuly']);
    }

    public function delete(ServiceCounty $county): JsonResponse
    {
        if ($county) {
            $county->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'County not found'], 404);
    }

    public function destroy($request): JsonResponse
    {
        $site_services = json_decode($request->site_services);
        foreach($site_services as $site_service){
            ServiceState::find($site_service)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }
}
