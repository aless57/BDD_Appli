<?php


namespace seance\model;


use Illuminate\Database\Eloquent\Model;

class Game_rating extends Model
{
    protected $table = 'game_rating';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function games(){
        return $this->belongsToMany(Game::class, "game2rating", "rating_id", "game_id");
    }
}