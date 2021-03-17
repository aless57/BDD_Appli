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

echo "Partie 1 : mesurer les performances et utiliser des index";
echo "<br>";
echo "<br>";
echo "Calcul du temps d'une requete sur la recherche des jeux commencant par Mario";
$time_start = microtime();

echo "<br>";
echo "<br>";
$listeJeu = model\Game::where('name','like','Mario %')->get();
foreach ($listeJeu as $jeu){
    $jeuMario = $jeu->characters;
    foreach ($jeuMario as $personnage) {
        echo "<b>Nom : </b>" . $personnage->name ."\n<br>";
    }
}
echo "<br>";

$time_end = microtime();
$time = $time_end = $time_start;

echo "Le temps est de $time";
echo "<br>";
echo "La premiere valeur est le temps d'éxecution, la deuxieme est le nombre de seconde depuis l'époque Unix";
