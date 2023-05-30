<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->get('/cadastro', 'LoginController@signup');

$router->post('/cadastro', 'LoginController@signupAction');
$router->post('/login', 'LoginController@signinAction');


//rota sair
$router->get('/sair', 'LoginController@logout');
$router->get('/teste', 'TestController@test');