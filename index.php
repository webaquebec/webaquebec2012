<?php

require "app/settings.php";
require "vendor/Slim/Slim.php";
require "libs/Slim-Extras/TwigView.php";

$app = new Slim($settings["Slim"]);

// ToDo: import routes


$app->run();