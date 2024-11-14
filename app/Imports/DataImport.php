<?php

namespace App\Imports;

use App\Models\Data;
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
        return new Data([
            'num'     => $row[0],
            'name'    => $row[1],
            'job' => $row[2],
            'idNum' => $row[3],
            'city' => $row[4],
            'location' => $row[5],
            'nationality' => $row[6],
            'status' => $row[7],
            'housing' => $row[8],
        ]);
    }
}
