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


//question 1
$annonce22 = model\Annonce::where('id', '=', '22')->first();
$listeannonce2 = $annonce22->photos()->get(); // $annonce22->photos
foreach ($listeannonce2 as $photo){
    echo $photo->id;
}

//question 2
$question2 = $annonce22->photos()->where('taille_octet','>=','100000')->get();

//question 3
$listeAnnonce = model\Annonce::all();
$question3 = $listeAnnonce->where($listeAnnonce->photos()->count() , ">=", "3")->get();

//Correction
$listeAnnonce = model\Annonce::has('photos','>=','3')->get();

//question 4
$question4 = $listeAnnonce->photos()->where('taille_octet','>=','100000')->get();

//question 4
$photo =  model\Photo::find(12);
$photo->id_annonce = 22;
$photo->save();

//question 5
$category42 = model\Categorie::find(42);
$category73 = model\Categorie::find(72);

$lien1 = new appartenanceCategorieAnnonce;
$lien2 = new appartenanceCategorieAnnonce;
$lien1->id_annonce = 22;
$lien2->id_annonce = 22;
$lien1->id_categorie = 42;
$lien2->id_categorie = 73;

$lien1->save();
$lien2->save();
