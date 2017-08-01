<?php

use ThreeFrame\Config;
use ThreeFrame\Http;
require_once __DIR__."/vendor/autoload.php";
require __DIR__."/app/routes.php";
Config::Init(__DIR__."/config.ini");
$app = new Http(Config::Get("server"));
$app->run();