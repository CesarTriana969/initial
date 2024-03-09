<?php

namespace App\Http\Controllers;

use App\Events\CompanyProfileUpdated;
use App\Models\CompanyProfile;
use App\Models\NotificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-company', ['only'=>['index']]);
        $this->middleware('permission:update-company', ['only'=>['update']]);
    }

    public function index(){
        $companyProfile = CompanyProfile::first();
        return view('admin.company-information.index', compact('companyProfile'));
    }

    public function update(Request $request){
        $companyProfile = CompanyProfile::first();
        $companyProfile->update($request->all());
        event(new CompanyProfileUpdated($companyProfile));
        return response()->json(['message' => 'Company Information Updated']);
    }

    public function notificationEmails(Request $request)
    {
        $search = $request->search;
        $emails = NotificationEmail::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('email', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();

        return response()->json($emails);
    }

    public function updateStatus(Request $request, NotificationEmail $email)
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|boolean',
            ]);

            $email->status = $validatedData['status'];
            $email->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }

    public function updateMainStatus(NotificationEmail $email)
    {
        try {
            $email->markAsMain();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:notification_emails,email',
        ]);
        $company = new NotificationEmail();
        // $company->fill($request->all());
        $company->email = $request->email;
        $company->status = true;
        $company->save();

        return response()->json(['message' => 'Data created successfully']);
    }

    public function destroy(Request $request)
    {
        $information = json_decode($request->information);
        
        foreach($information as $info){
            NotificationEmail::find($info)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }

    public function getMicrosoftToken()
    {
        $url = config('services.microsoft.domain') . config('services.microsoft.app_id') . config('services.microsoft.endpoint');

        $response = Http::asForm()->post($url, [
            'grant_type' => config('services.microsoft.grant_type'),
            'client_id' => config('services.microsoft.client_id'),
            'client_secret' => config('services.microsoft.client_secret'),
            'scope' => config('services.microsoft.scope'),
        ]);

        $tokenData = $response->json();
        $companyProfile = CompanyProfile::first();
        $companyProfile->microsoft_access_token = $tokenData['access_token'];
        $companyProfile->save();

        return response()->json(['access_token' => $tokenData['access_token']]);
    }

 
}
