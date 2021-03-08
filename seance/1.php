<?php

use confBDD\Eloquent;

require_once "../vendor/autoload.php";

$config = require_once  "../conf/settings.php";

Eloquent::start($config['settings']['dbfile']);

echo "bla";