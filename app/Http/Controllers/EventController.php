<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Acesso ao Model de Event */
use App\Models\Event;

class EventController extends Controller
{
    public function index() {

        /* Search */
        $search = request('search');

        if($search) {

            /* filtrar registros */
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        } else {
            /* chama todos os eventos do banco */
            $events = Event::all();
        }

        /* passa todos eventos para a view */
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    /* Salvando dados no banco MySQL */
    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        /* Image Upload */
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }
        
        /* pega usuário logado e add no banco */
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        
        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}
