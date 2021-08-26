<?php

use CoffeeCode\Router\Router; 

require_once __DIR__ . '/vendor/autoload.php';
header('Content-type: application/json');
error_reporting(0);

//$router = new Rout
$router = new Router("http://localhost/tecnofit2");

$router->namespace("Domain\Services\Infra\Http");

$router->group("/user");
$router->post('/', "UserController:create");
$router->get('/{id}', "UserController:index");
$router->get('/', "UserController:show");


$router->namespace("Domain\Services\Infra\Http");

$router->group("/ranking");
$router->get('/movement/{id}', "RankingController:showRankingForMovement");
$router->get('/user/{id}', "RankingController:showRankingForUser");




/*
 * ERRORS
 */
$router->group("ooops");
$router->get("/{errcode}", function($data) {
    echo json_encode(["erro" => ["code" => "{$data['errcode']}"]]);
});

$router->dispatch();


// if($router->error()) {
//     $router->redirect("/ooops/{$router->error()}");
// }


