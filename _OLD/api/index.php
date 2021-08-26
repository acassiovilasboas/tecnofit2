<?php

require_once '../vendor/autoload.php';

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE . '/api');


/*
 * Controllers
 */
$router->namespace("App\Controllers");

//$router->group(null);
$router->get('/', function(){echo "<a href='https://documenter.getpostman.com/view/9912123/Tzz8rwf5' target='_blank'>Consulte a documentação</a>";});


/*
 * RANKING
 */
$router->group("ranking");
$router->get('/', "Ranking:index");
$router->get('/user/{id}', "Ranking:findUserById");
$router->get('/movement/{id}', "Ranking:findMovementById");


/*
 * MOVEMENT
 */
$router->group("movement");
$router->get('/', "Movement:index");


/*
 * USER
 */
$router->group("user");
$router->get('/', "User:index");
$router->get('/{id}', "User:findById");


/*
 * ERRORS
 */
$router->group("ooops");
$router->get("/{errcode}", function($data) {
    echo json_encode(["erro" => ["code" => "{$data['errcode']}"]]);
});


$router->dispatch();

if($router->error()) {
    $router->redirect("/ooops/{$router->error()}");
}

