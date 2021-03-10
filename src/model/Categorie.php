<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function appartientAnnonces(){
        return $this->belongsToMany(model\Annonce, id_annonce);
    }

    public function annonces(){
        return $this->hasMany(model\Annonce, id_annonce);
    }
}