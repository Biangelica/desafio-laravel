<?php

namespace App\Imports;

use App\Event;
use Maatwebsite\Excel\Concerns\ToModel;

class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Event([
            'title' => $row["title"],
            'start' => $row["start"],
            'end' => $row["end"],
            'description' => $row["description"],
        ]);
    }
}
