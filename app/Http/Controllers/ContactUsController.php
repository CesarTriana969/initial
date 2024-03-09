<?php

namespace App\Http\Controllers;

use App\Actions\Panel\ContactUs\Interfaces\ContactUsInterface;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $contactUsInterface;

    public function __construct(ContactUsInterface $contactUsInterface)
    {
        $this->contactUsInterface = $contactUsInterface;

        $this->middleware('permission:view-leads', ['only'=>['index','leads', 'updateStatus']]);
        $this->middleware('permission:delete-lead', ['only'=>['destroy']]);
    }

    public function index(){
        return view('admin.leads.index');
    }

    public function leads(Request $request): JsonResponse
    {
       return $this->contactUsInterface->leads($request);
    }

    public function updateStatus(Request $request, ContactUs $contact): JsonResponse
    {           
        return $this->contactUsInterface->updateStatus($request, $contact);
    }

    public function destroy(Request $request): JsonResponse
    {
        return $this->contactUsInterface->destroy($request);
    }
}
