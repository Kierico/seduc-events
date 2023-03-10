<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Acesso ao Model de Event */
use App\Models\Event;
use App\Models\User;

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

        /* verifica se o usuário já participa do evento */
        $user = auth()->user();
        $hasUserJoined = false;
        if($user) {

            $userEvents = $user->eventsAsParticipants->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {

                    $hasUserJoined = true;

                }
            }

        }

        /* acesso ao usuário */
        $eventOwner = User::where('id', '=', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {

        $user = auth()->user();

        /* eventos do usuário */
        $events = $user->events;

        /* eventos que o usuário participa */
        $eventsAsParticipants = $user->eventsAsParticipants;

        return view('events.dashboard', ['events' => $events, 'eventsAsParticipants' => $eventsAsParticipants]);
    }

    public function destroy($id) {

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');

    }

    public function edit($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        /* verificação para que somente o usuário dono do evendo possa edita-la */
        if($user->id != $event->user_id) {

            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);

    }

    public function update(Request $request) {

        $data = $request->all();

        /* Image Upload */
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

    public function joinEvent($id) {

        $user = auth()->user();

        /* faz a ligação */
        $user->eventsAsParticipants()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);

    }

    /* sair de um evento "desfaz a ligação */
    public function leaveEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipants()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento ' . $event->title);

    }
}
