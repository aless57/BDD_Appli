<?php

use seance\model;

require '../vendor/autoload.php';

$config = ['settings' => [
    'displayErrorDetails' => true,
]];

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$container = new \Slim\Container($config);
$app = new \Slim\App($container);

$matchThese = [];

//$v = Ville::where('id','=',2)->first() ;
//$v->hasMany('\model\Club,'ville_id')->get() ;



$annonce22 = model\Annonce::where('id', '=', '22')->first();
$question2 = $annonce22->photos()->where('taille_octet','>=','100000')->get();

$listeAnnonce = model\Annonce::all();
$question3 = $listeAnnonce->where($listeAnnonce->photos()->count() , ">=", "3")->get();

$question3 = $listeAnnonce->photos()->where('taille_octet','>=','100000')->get();

User::create(['name' => 'Durand', 'email' => 'durand@chezlui.fr', 'password' => 'pass'])
    /**
    $posts = App\Post::withCount(['votes', 'comments' => function ($query) {
        $query->where('content', 'like', 'foo%');
    }])->get();**/
