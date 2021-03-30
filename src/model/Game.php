<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {
    protected $table = 'game'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function characters(){
        return $this->belongsToMany(Character::class, "game2character", "game_id", "character_id");
    }

    public function companys(){
        return $this->belongsToMany(Company::class, "game_developers", "game_id", "comp_id");
    }

    public function games_rating(){
        return $this->belongsToMany(Game_rating::class, "game2rating", "game_id", "rating_id");
    }

}