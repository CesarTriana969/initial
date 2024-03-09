<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class ClientsImport implements ToModel, WithStartRow
{
   
    public function model(array $row)
    {
        return new Customer([
            'first_name'    => $row[1],
            'email'         => $row[0],
            'phone_number'  => $row[2],
            'company_name'  => $row[1],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
