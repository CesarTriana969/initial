<?php

namespace App\Actions\Panel\Client\Interfaces;

interface ClientInterface
{
    public function clients($request);
    public function edit($client);
    public function update($request, $client);
    public function destroy($request);
    public function uploadSingleFile($request, $client);
    public function importExcel($request);
}
