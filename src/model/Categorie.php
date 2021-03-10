<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function annonces(){
        return $this->belongsToMany("model\Annonce", "appartenanceCategorieAnnonce", "categorie_id", "annonce_id");
    }

}