<?php

namespace App\Imports;

use App\Models\Export;
use App\Models\Folder;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;


class DataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $exports =  new Export([
            'title' => $row[0],
            'description' => $row[1],
            'total_quantity' => $row[2],
            'country' => $row[3],
            'city' => $row[4],
            'company_name' => $row[5],
            'company_address' => $row[6],
            'company_phone' => $row[7],
            'company_mail' => $row[8],
            'request_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(date((int)$row[9])),
            'deadline' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(date((int)$row[10])),
        ]);
        return $exports;
    }
}
