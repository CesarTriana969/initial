<?php

use App\Models\ServiceCounty;
use Illuminate\Support\Facades\DB;
use App\Models\System\Service\ServiceAreaCounty;

function changeWordsInCKEDITOR(String $html): String 
{
    $newHTML = $html;
    
    /****************************services(counties)****************************/ 
    $services = DB::table('site_services')->get();
    foreach ($services as $service) {

        if (str_contains($html, '{service(' . $service->slug . ')}')) {
            $counties = DB::table('service_counties')
                ->join('service_states', 'service_counties.service_state_id', '=', 'service_states.id')
                ->select('service_counties.*', 'service_states.name as state_name', 'service_states.abv as state_abv')
                ->get();

            $servicesLikeHTML = collect($counties)->map(function ($county) use ($service) {
                $stateSegment = $county->state_name === 'Connecticut' ? 'connecticut' : 'massachusetts';
                $title = ucfirst(strtolower($service->title));
                $countyName = ucfirst(strtolower($county->name));
                $stateName = ucfirst(strtolower($county->state_name));
                $stateAbv = strtoupper($county->state_abv);

                // return "<a href=\"/service/{$service->slug}/{$stateSegment}/{$county->slug}\" style='color: #007bff;'>{$title} in {$countyName}, {$stateName}, {$stateAbv} |</a>";
                return "<a href=\"/services-content/{$service->slug}\" style='color: #007bff;'>{$title} in {$countyName}, {$stateName}, {$stateAbv} |</a>";
            })->implode(' ');

            $newHTML = str_replace('{service(' . $service->slug . ')}', $servicesLikeHTML, $newHTML);
        }
    }

    /****************************services(general)****************************/ 
    if (str_contains($html, '{service(schedule-today)}')) {
        $counties = DB::table('service_counties')
            ->join('service_states', 'service_counties.service_state_id', '=', 'service_states.id')
            ->select('service_counties.*', 'service_states.name as state_name', 'service_states.abv as state_abv')
            ->get();

        $servicesLikeHTML = collect($counties)->map(function ($county) use ($service) {
            $stateSegment = $county->state_name === 'Connecticut' ? 'connecticut' : 'massachusetts';
            $title = ucfirst(strtolower('schedule-today'));
            $countyName = ucfirst(strtolower($county->name));
            $stateName = ucfirst(strtolower($county->state_name));
            $stateAbv = strtoupper($county->state_abv);

            // return "<a href=\"/service/{$service->slug}/{$stateSegment}/{$county->slug}\" style='color: #007bff;'>{$title} in {$countyName}, {$stateName}, {$stateAbv} |</a>";
            return "<a href=\"/schedule-today\" style='color: #007bff;'>Schedule your Financial Services in {$countyName}, {$stateName}, {$stateAbv}|</a>";
        })->implode(' ');

        $newHTML = str_replace('{service(schedule-today)}', $servicesLikeHTML, $newHTML);
    }

    return $newHTML;

    // !empty($newHTML) ? $html = $newHTML : '';
    // $services = DB::select('select * from site_services');
    // foreach($services as  $service){
    //     !empty($newHTML) ? $html = $newHTML : '';
    //     if(str_contains($html,'{service('.$service->slug.')}')){
    //         $counties = ServiceCounty::all();
    //         $servicesLikeHTML = '';
    //         foreach($counties  as $county):
    //             if (str_contains($html, '{service(' . $service->slug . ')}')) {
    //                         $counties = DB::table('service_counties')
    //                             ->join('service_states', 'service_counties.service_state_id', '=', 'service_states.id')
    //                             ->select('service_counties.*', 'service_states.name as state_name', 'service_states.abv as state_abv')
    //                             ->get();
                
    //                         $servicesLikeHTML = collect($counties)->map(function ($county) use ($service) {
    //                             $stateSegment = $county->state_name === 'Connecticut' ? 'connecticut' : 'massachusetts';
    //                             $title = ucfirst(strtolower($service->title));
    //                             $countyName = ucfirst(strtolower($county->name));
    //                             $stateName = ucfirst(strtolower($county->state_name));
    //                             $stateAbv = strtoupper($county->state_abv);
                
    //                             return "<a href=\"/service/{$service->slug}/{$stateSegment}/{$county->slug}\">{$title} in {$countyName}, {$stateName}, {$stateAbv} |</a>";
    //                         })->implode(' ');
    //                 }
                

    //         endforeach;
    //         $newHTML = str_replace('{service('.$service->slug.')}', $servicesLikeHTML, $html);
    //     }
    // }

    // if(empty($newHTML)){
    //     return $html;
    // }else{
    //     return $newHTML;
    // }
}

