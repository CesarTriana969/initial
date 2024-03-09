<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Customer;
use App\Models\QuoteRequest;
use App\Models\RequestedCertificate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Customer::count();
        $leads = ContactUs::count();
        $quotesRequest = QuoteRequest::count();
        return view('home', compact(['clients', 'leads', 'quotesRequest']));
    }
}
