<?php

use ThreeFrame\Config;
use ThreeFrame\Http;
use ThreeFrame\View;

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/app/handles/HomeHandle.php";
require __DIR__."/app/routes.php";
Config::Init(__DIR__."/config.ini");
View::setPath(__DIR__."/app/views/");
$app = new Http(Config::Get("server"));
$app->run();