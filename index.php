<?php

require "app/settings.php";
require "vendor/Slim/Slim.php";

$app = new Slim($settings["Slim"]);

// import routes


$app->run();