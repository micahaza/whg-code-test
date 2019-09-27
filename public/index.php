<?php

use WhiteHatApi\AppBuilder;

require '../vendor/autoload.php';

session_start();

$app = AppBuilder::buildApp();

$app->run();