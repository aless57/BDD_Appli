<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model {
    protected $table = 'annonce';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function photos(){
        return $this->hasMany(model\Photo, id_photo);
    }

    public function categories(){
        return $this->belongsToMany(model\Categorie, id_categorie);
    }
}