<?php

use seance\model\Game;
use seance\model\Character;
use \seance\model\Company;
use Illuminate\Database\Capsule\Manager as DB;

require '../vendor/autoload.php';

$config = ['settings' => [
    'displayErrorDetails' => true,
]];

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
echo "<h1> TD 3 BDD Application </h1>\n\n";
echo "<br>";
echo "<br>";

echo "<h1> Lister l'ensemble des jeux </h1>";
echo "<br>";
echo "<br>";
$time_start = microtime();
$listGame = Game::all();
$time_end = microtime();
$time = $time_end = $time_start;


foreach($listGame as $game){
    echo " $game->name .<br>" ;
}

echo "Le temps est de $time";
echo "<br>";    


echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'Mario' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Mario%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuMario = $jeu->name;
    echo "<b>Nom : </b>" . $jeuMario ."\n<br>";
}

echo "Le temps est de $time";
echo "<br>";    

echo "\n<br>";
echo "<br>";

echo "<h2> Les personnages des jeux dont le nom (du jeu) débute par 'Mario' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Mario %')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuMario = $jeu->characters;
    foreach ($jeuMario as $personnage) {
        echo "<b>Nom : </b>" . $personnage->name ."\n<br>";
    }
}
echo "Le temps est de $time";
echo "<br>";    

echo "\n<br>";
echo "<br>";

echo "<h2> Les jeux dont le nom débute par Mario et dont le rating initial contient 3+ </h2>\n";
echo "<br>";
$time_start = microtime();
$jeu3 = Game::where('name','like','%Mario%')->whereHas("games_rating", function($q) {
    $q->where('name', 'like', '%3+');
})->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($jeu3 as $jeu){
    echo "<b>Nom : </b>" . $jeu->name . "\n<br>";
}
echo "<br>";

echo "Le temps est de $time";
echo "<br>"; 


echo "<h1>Etudier la requête :lister les jeux dont le nom débute par '<valeur>' </h1> <br>"; 
echo "<br>"; 

echo "<h1>Question 1 : mesurer son temps d'exécution avec 3 valeurs différentes </h1>"; 


echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'Sonic' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Sonic%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuSonic = $jeu->name;
    echo "<b>Nom : </b>" . $jeuSonic ."\n<br>";
}
echo "<br>";
echo "Le temps pour le jeu qui débute par Sonic est de $time";
echo "<br>"; 


echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'Smash' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Smash%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuSmash = $jeu->name;
    echo "<b>Nom : </b>" . $jeuSmash ."\n<br>";
}
echo "<br>";
echo "Le temps pour le jeu qui débute par Smash est de $time";
echo "<br>"; 

echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'League' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','League%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuLeague = $jeu->name;
    echo "<b>Nom : </b>" . $jeuLeague ."\n<br>";
}
echo "<br>";
echo "Le temps pour le jeu qui débute par League est de $time";
echo "<br>"; 



echo "<h1>Question 3 : mesurer à nouveau le temps d'exécution avec 3 nouvelles valeurs (Creation index sur la colonne name de la table Game)</h1>";



echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'Mortal' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Mortal%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuMortal = $jeu->name;
    echo "<b>Nom : </b>" . $jeuMortal ."\n<br>";
}

echo "<br>";
echo "Le temps pour le jeu qui débute par Mortal est de $time";
echo "<br>";

echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'Rocket' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Rocket%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuRocket = $jeu->name;
    echo "<b>Nom : </b>" . $jeuRocket ."\n<br>";
}

echo "<br>";
echo "Le temps pour le jeu qui débute par Rocket est de $time";
echo "<br>";

echo "<h2> Le nom des jeux dont le nom (du jeu) débute par 'Call' </h2>\n";
echo "<br>";
$time_start = microtime();
$listeJeu = Game::where('name','like','Call%')->get();
$time_end = microtime();
$time = $time_end = $time_start;
foreach ($listeJeu as $jeu){
    $jeuCall = $jeu->name;
    echo "<b>Nom : </b>" . $jeuCall ."\n<br>";
}

echo "<br>";
echo "Le temps pour le jeu qui débute par Call est de $time";
echo "<br>";


echo "<h1>Programmez une fonction d'affichage du log de requêtes de façon à ce qu'il soit lisible</h1>";


echo "<br>";
echo "<h1>Lister les jeux dont le nom contient 'Mario'</h1>";
echo "<br>";
DB::connection()->enableQueryLog();
$i = 0;
$listeJeu = Game::where('name','like','Mario%')->get();


echo "Nombre de requetes : $i";
DB::connection()->disableQueryLog();
echo "<br>";
echo "<br>";
echo "<h1>Afficher le nom des personnages du jeu 12342</h1>";
echo "<br>";

DB::connection()->enableQueryLog();
$i = 0;
$personnage12342 = Game::find('12342');
$salut = $personnage12342->characters;
echo "<br>";
echo "<br>";
echo "<h1>Afficher les noms des persos apparus pour la 1ère fois dans 1 jeu dont le nom contient Mario</h1>";

$listePerso = Character::whereHas("games", function($q){
    $q->where("name","like","%Mario%");
})->get();

foreach ($listePerso as $perso){
    $jeu = $perso->first_appeared_in_game_id;
//    $game = Game::where("name","like","%Mario%");
//    $gameID = $game->where("id","=",$jeu)->get();
    $game = Game::where("name","like","%Mario%")->where("id","=",$jeu)->first();
    echo "Nom du perso : " . $perso->name . "<br>" . "Nom du jeu" . $game->name . "<br>";
}



foreach( DB::getQueryLog() as $q){
    $i++;
    echo "-------------- <br>\n";
    echo "query : " . $q['query'] ."<br>\n";
    echo " --- bindings : [ ";
    foreach ($q['bindings'] as $b ) {
        echo " ". $b."," ;
    }
    echo " ] ---<br>\n";
    echo "-------------- <br><br>\n \n";
};

echo "Nombre de requetes : $i";