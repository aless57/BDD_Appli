<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {
    protected $table = 'genre';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function jeux(){
        return $this->belongsToMany(Company::class, "game2genre", "genre_id", "game_id");
    }
}