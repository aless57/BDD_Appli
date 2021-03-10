<?php


namespace seance\model;


use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'character';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function games(){
        return $this->belongsToMany(Game::class, "game2character", "character_id", "game_id");
    }
}