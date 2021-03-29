<?php


namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $timestamps = false;

    public function commentaires(){
        return $this->hasMany("model\Commentaire", "email");
    }
}

