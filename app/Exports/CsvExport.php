<?php

namespace App\Exports;

use App\Event;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsvExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Event::where('id_users', Auth::user()->id)->select('title', 'start', 'end', 'description')->get();
    }
}
