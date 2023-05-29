<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->get('/cadastro', 'LoginController@signup');

$router->post('/cadastro', 'LoginController@signupAction');
$router->post('/login', 'LoginController@signinAction');
$router->post('/post/new', 'PostController@new');


//rota sair
$router->get('/sair', 'LoginController@logout');