<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Client\Interfaces\ClientInterface;
use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use App\Models\Customer;
use App\Models\File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    protected $clientInterface;

    public function __construct(ClientInterface $clientInterface ){
        $this->clientInterface = $clientInterface;

        $this->middleware('permission:view-clients', ['only'=>['index','clients', 'export']]);
        $this->middleware('permission:create-client', ['only'=>['create','store']]);
        $this->middleware('permission:edit-client', ['only'=>['edit','update']]);
        $this->middleware('permission:delete-client', ['only'=>['destroy']]);
    }

    public function index(){
        return view('admin.clients.index');
    }

    public function clients(Request $request){
        return $this->clientInterface->clients($request);
    }

    public function edit($client){
       return $this->clientInterface->edit($client);
    }

    public function getClient(Customer $client){
        return response()->json($client);
    }

    public function export() {
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }

    public function update(Request $request, Customer $client){
        return $this->clientInterface->update($request, $client);
    }

    public function destroy(Request $request){
        return $this->clientInterface->destroy($request);
    }

    public function uploadSingleFile(Request $request, $client){
        return $this->clientInterface->uploadSingleFile($request, $client);
    }

    public function importExcel(Request $request){
        return $this->clientInterface->importExcel($request);
    }
}
