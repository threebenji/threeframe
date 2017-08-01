<?php

use ThreeFrame\Config;
use ThreeFrame\Http;
use ThreeFrame\ORM;

require_once __DIR__."/vendor/autoload.php";
require __DIR__."/app/routes.php";
Config::Init(__DIR__."/config.ini");
Orm::Init(Config::Get("database"));
$app = new Http(Config::Get("server"));
$app->run();