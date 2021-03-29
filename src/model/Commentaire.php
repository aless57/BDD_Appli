<?php


namespace seance\model;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $table = 'commentaire';
    protected $primaryKey = 'id';
    public $timestamps = true;


}