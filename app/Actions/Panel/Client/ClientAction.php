<?php

namespace App\Actions\Panel\Client;

use App\Actions\Panel\Client\Interfaces\ClientInterface;
use App\Imports\ClientsImport;
use App\Models\Customer;
use App\Models\File;
use Maatwebsite\Excel\Facades\Excel;

class ClientAction implements ClientInterface
{
    public function clients($request){
        $search = $request->get('search');
        $order = $request->get('order');
        $users = Customer::where('id', 'LIKE', '%'.$search.'%')
            ->orwhere('first_name', 'LIKE', '%'.$search.'%')
            ->orwhere('last_name', 'LIKE', '%'.$search.'%')
            ->orwhere('email', 'LIKE', '%'.$search.'%')
            ->orwhere('phone_number', 'LIKE', '%'.$search.'%')
            ->orderBy('id', $order)         
            ->paginate(7);
        
        return response()->json($users, 200);
    }

    public function edit($client){
        $client = Customer::find($client);
        $client->load(['files']);
        $certificates = $client->files;
        return view('admin.clients.edit', compact('client'));
    }

    public function update($request, $client){
        $client = $client->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'), 
            'email' => $request->input('email'), 
            'phone_number' => $request->input('phone_number'), 
            'company_name' => $request->input('company_name'), 
            'birth_day' => $request->input('birth_day'), 
            'address' => $request->input('address'), 
            'apt' => $request->input('apt'), 
            'city' => $request->input('city'), 
            'state' => $request->input('state'), 
            'zip_code' => $request->input('zip_code'), 
        ]);

        return response()->json([
            'message' => 'Updated Successfully!.',
        ], 200); 
    }

    public function destroy($request){
        $clients = json_decode($request->clients);
        
        foreach($clients as $client){
            Customer::find($client)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }

    public function uploadSingleFile($request, $client)
    {
        $client = Customer::find($client);
        if (!$client) {
            return response()->json(['message' => 'Customer not found.'], 404);
        }

        $file = $request->file('file');
        $documentName = $request->input('document_name');
        $fileModel = $this->uploadFile($file, $client, $documentName);

        return response()->json(['message' => 'File uploaded successfully.', 'filePath' => $fileModel->file_path]);
    }

    protected function uploadFile($file, $client, $fileName)
    {
        $filePath = $file->store('uploads');
        $fileModel = new File();
        $fileModel->file_path = $filePath;
        $fileModel->file_key = $fileName;
        $client->files()->save($fileModel);
        return $fileModel;
    }

    public function importExcel($request)
    {
        try {
            Excel::import(new ClientsImport, $request->file('clients'));

            return response()->json('successfuly');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
