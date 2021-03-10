<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {
    protected $table = 'photo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function annonce(){
        return $this->belongsTo("model\Annonce", "id_annonce");
    }
}