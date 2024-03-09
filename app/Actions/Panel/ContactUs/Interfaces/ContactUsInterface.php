<?php

namespace App\Actions\Panel\ContactUs\Interfaces;

use App\Models\ContactUs;

interface ContactUsInterface
{
    public function leads($request);
    public function updateStatus($request, ContactUs $contact);
    public function destroy($request);
}
