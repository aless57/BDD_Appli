<?php

use seance\model\Game;
use seance\model\Character;
use \seance\model\Company;

require '../vendor/autoload.php';

$config = ['settings' => [
    'displayErrorDetails' => true,
]];

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

echo "<h1> TD 2 BDD Application </h1>\n\n";
echo "<br>";
echo "<br>";



echo "<h2> Afficher (name , deck) les personnages du jeu 12342 </h2>\n";
echo "<br>";
$personnage12342 = Game::find('12342');
$salut = $personnage12342->characters;
foreach ($salut as $personnage){
    echo "<b>Name : </b> " . $personnage->name . " <b>Deck :</b> " . $personnage->deck . "\n<br>";
}
echo "\n<br>";
echo "<br>";


echo "<h2> Les personnages des jeux dont le nom (du jeu) débute par 'Mario' </h2>\n";
echo "<br>";
$listeJeu = Game::where('name','like','Mario %')->get();
foreach ($listeJeu as $jeu){
    $jeuMario = $jeu->characters;
    foreach ($jeuMario as $personnage) {
        echo "<b>Nom : </b>" . $personnage->name ."\n<br>";
    }
}
echo "\n<br>";
echo "<br>";


echo "<h2> Les jeux développés par une compagnie dont le nom contient 'Sony' </h2>\n";
echo "<br>";
$sony = Company::where('name','like','%sony%')->get();
foreach ($sony as $comp){
    $jeux = $comp->games;
    foreach ($jeux as $jeu) {
        echo "<b>Nom : </b>" . $jeu->name . "\n<br>";
    }
}
echo "\n<br>";
echo "<br>";

echo "<h2> Le rating initial (indiquer le rating board) des jeux dont le nom contient Mario </h2>\n";
echo "<br>";



