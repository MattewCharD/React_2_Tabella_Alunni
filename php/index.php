<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/includes/Db.php';

$app = AppFactory::create();

$app->get('/alunni', "AlunniController:index");

$app->run();
