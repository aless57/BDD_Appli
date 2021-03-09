<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model {
    protected $table = 'annonce';
    protected $primaryKey = 'id';
    public $timestamps = false;
}