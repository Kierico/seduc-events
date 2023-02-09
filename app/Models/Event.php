<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    /* tudo que for enviado pelo POST pode atualizar sem restrição */
    protected $guarded = [];

    /* usuário dono do evento "para saber quais são os eventos dele". */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    /* pertence a muitos  */
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
