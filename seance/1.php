<?php

use confBDD\Eloquent;

require_once __DIR__ . "/vendor/autoload.php";

$config = require_once __DIR__ . "/conf/settings.php";

Eloquent::start($config['settings']['dbfile']);