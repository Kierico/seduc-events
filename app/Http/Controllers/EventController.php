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
}
