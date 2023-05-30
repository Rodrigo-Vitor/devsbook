<?php
namespace src\controllers;

use src\handlers\LoginHandler;
use \core\Controller;
use src\handlers\PostHandler;

class PostController extends Controller {
    private $loggedUser;

    public function __construct() {
        $this->loggedUser = LoginHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function new() {
        $body = filter_input(INPUT_POST, 'body');
        
        if($body) {
            PostHandler::addPost($this->loggedUser->id, 'text', $body);
        }

        $this->redirect('/');
    }

}