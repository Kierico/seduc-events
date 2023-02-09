<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Acesso ao Model de Event */
use App\Models\Event;

class EventController extends Controller
{
    public function index() {

        /* chama todos os eventos do banco */
        $events = Event::all();

        /* passa todos eventos para a view */
        return view('welcome', ['events' => $events]);
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

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        
        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}
