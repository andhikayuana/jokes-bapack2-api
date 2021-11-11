<?php

error_reporting(E_ALL | E_STRICT);
$rootDir = dirname(__FILE__, 2);

require $rootDir . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$app = new \Yuana\JokesBapack2Api\App($rootDir);
$app->run();