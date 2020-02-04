<?php

namespace App\Http\Controllers;

use App\Event;
use App\Exports\CsvExport;
use App\Imports\CsvImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class CsvFile extends Controller
{
    public function csv_index(){
        $data = Event::latest()->paginate(10);
        return view('csv_file', compact('data'))
            ->with('i',(request()->input('page', 1)-1)*10);
    }

    public function csv_export(){
        return Excel::download(new CsvExport, 'sample.csv');
    }

    public function csv_import(Request $request)
    {
        //Excel::import(new CsvImport, request()->file('file'));
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();

        $data = Excel::load($path)->get();
        if($data->count() >0){
            foreach ($data->toArray() as $key => $value)
            {
                foreach ($value as $row){
                    $insert_data[] = array(
                        'Title' => $row['title'],
                        'Start' => $row['start'],
                        'End' => $row['end'],
                        'Description' => $row['description']
                    );
                }
            }
            if(!empty($insert_data)){
                DB::table('events')->insert($insert_data);
            }
        }
        return back()->with('sucess', 'Excel data Imported successfully');
    }
}
