<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

//Login Controller
$router->get('/login', 'LoginController@signin');
$router->get('/cadastro', 'LoginController@signup');

$router->post('/cadastro', 'LoginController@signupAction');
$router->post('/login', 'LoginController@signinAction');
$router->post('/post/new', 'PostController@new');

//Profile Controller
$router->get('/perfil/{id}', 'ProfileController@index');
$router->get('/perfil', 'ProfileController@index');

//rota sair
$router->get('/sair', 'LoginController@logout');
$router->get('/teste', 'TestController@test');