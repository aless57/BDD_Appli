<?php

namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = false;
}