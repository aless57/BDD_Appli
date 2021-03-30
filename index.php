<?php
declare(strict_types=1);

session_start();

use seance\controller\ControleurAPI;

require 'vendor/autoload.php';


$config = ['settings' => [
    'displayErrorDetails' => true,
]];
$container = new \Slim\Container($config);

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('src/conf/db.config.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$container = new \Slim\Container($config);
$app = new \Slim\App($container);


//Chemin Accueil
$app->get('/api/games/{id}', ControleurAPI::class.':generateObjAPI')->setName('affichageUnJeu');
$app->get('/api/games', ControleurAPI::class.':affichageJeux')->setName('affichage200Jeu');
$app->get('/api/games/{id}/', ControleurAPI::class.':affichageJeux')->setName('affichage200Jeu');


$app->run();