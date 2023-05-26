<?php
namespace src\controllers;

use src\handlers\LoginHandler;
use \core\Controller;

class HomeController extends Controller {
    private $loggedUser;

    public function __construct() {
        $this->loggedUser = LoginHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index() {
        $this->render('home', [
            'loggedUser' => $this->loggedUser
        ]);
    }

}