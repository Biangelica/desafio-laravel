<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use League\Csv\Writer;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use function foo\func;
use App\Exports\CsvExport;
use App\Imports\CsvImport;

class EventController extends Controller
{
    public function create(){
        request()->session()->regenerateToken();
        return view('master');
    }

    public function store(Request $request, Event $event)
    {
        // Insere uma nova categoria, de acordo com os dados informados pelo usuário

        $insert = $event->create($request->all());


        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                ->route('index')
                ->with('success', 'Evento inserido com sucesso!');

        // Redireciona de volta com uma mensagem de erro
        return redirect()
            ->back()
            ->with('error', 'Falha ao inserir');
    }

    public function index(){

        $events =  Event::orderBy('start')->where('id_users', Auth::user()->id)->paginate(10);

        return view('show', ['events' => $events,]  );
    }

    public function edit($eventid){

        $event = Event::all()->where('id', $eventid);

        return view('edit', ['events' => $event,]);
    }

    public function update(Request $request, $eventid){
       $dataForm = $request->all();
        $event = Event::find($eventid);
        $event->update($dataForm);

            return redirect()
                ->route('index')
                ->with('success', 'Evento atualizado com sucesso!');

    }

    public function destroy(Request  $request, $eventid){
        $dataForm = $request->all();
        $event = Event::find($eventid);
        $event->delete();

        return redirect()
            ->route('index')
            ->with('success', 'Evento atualizado com sucesso!');

    }

    /*function today(){
       // $td_event = mysqli_query('SELECT * FROM events WHERE start BETWEEN CAST(DATEADD(day, +1, GETDATE()) AS DATE) AND CAST(GETDATE() AS DATE) ');
        $from = date('yyyy/mm/dd');
        $events = Event::select('title', 'start', 'end', 'description')->whereBetween('start',[DB::raw('CAST(DATEADD(day, +1, GETDATE()) AS DATE)'), DB::raw('CAST(GETDATE() AS DATE)')])->get();

        return view('show', ['events' => $events,]  );
    }


    function nextfiv(){
        return $td_event = mysqli_query('SELECT id FROM events WHERE start BETWEEN CAST(DATEADD(day, +5, GETDATE()) AS DATE) AND CAST(GETDATE() AS DATE) ');

    }*/

}
