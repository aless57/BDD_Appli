<?php

use confBDD\Eloquent;
use Illuminate\Database\Eloquent\Model;
use model\Game;

require_once "../vendor/autoload.php";

$config = require_once  "../conf/settings.php";

Eloquent::start($config['settings']['dbfile']);

$liste = Game::where('name', 'like', '%mario%')->get();
foreach($liste as $game) {
    echo $game ->name . ' : ' . $game->alias . "\n";
}

echo "Jeux dont le titre contient Mario : " . count($liste) . "\n\n";