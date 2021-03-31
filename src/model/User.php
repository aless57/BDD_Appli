<?php


namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function commentaires(){
        return $this->hasMany(Commentaire::class, "email");
    }
}

