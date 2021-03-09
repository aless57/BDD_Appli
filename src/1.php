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

echo "<h1> Lister les jeux dont le nom contient 'Mario' </h1>";
echo "<br>";
$liste1 = model\Game::where('name', 'like', '%mario%')->get();
foreach($liste1 as $game) {
    echo $game ->name . ' : ' . $game->alias . "<br>";
}
echo "<br>";
echo "<h2>Jeux dont le titre contient Mario : </h2>" . count($liste1) . "\n\n";
echo "<br>";
echo "<br>";
echo "<h1> Lister les compagnies installées au Japon </h1>";
echo "<br>";
$liste2 = model\Company::where('location_country', 'like' , 'Japan')->get() ;
foreach ($liste2 as $company) {
    echo $company->name . "<br>";
}
echo "<br>";
echo "<h2>Compagnies basées au japon : </h2>" . count($liste2) . "\n\n";
echo "<br>";
echo "<br>";
echo "<h1> Lister les plateformes dont la base installée est >= 10 000 000 </h1>";
echo "<br>";
$liste3 = model\Platform::where('install_base', '>=', '10 000 000')->get();
foreach($liste3 as $platform) {
    echo $platform->name . "<br>";
}
echo "<br>";
echo "<h2>Plateformes dont la base installée est supérieur à 10 000 000 :</h2>" . count($liste3) . "<br>";
echo "<br>";
echo "<br>";
echo "<h1> Lister 442 jeux à partir du 21173ème </h1>";
echo "<br>";
$liste4 = model\Game::where('id','>','21173')->get();
$inc = 0;
// a refaire plus propre
foreach ($liste4 as $games){
    if($inc<=441){
        echo $games->name . " " . $games->id . "<br>";
        $inc++;
    }
}
echo "<h2>NB : </h2>" . $inc;
echo "<br>";
echo "<br>";