<?php
namespace src\controllers;

use src\handlers\LoginHandler;
use \core\Controller;
use src\handlers\PostHandler;

class HomeController extends Controller {
    private $loggedUser;

    public function __construct() {
        $this->loggedUser = LoginHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index() {
        $page = intval(filter_input(INPUT_GET, 'page'));

        $feed = PostHandler::GetHomeFeed($this->loggedUser, $page);
        $this->render('home', [
            'loggedUser' => $this->loggedUser,
            'feed' => $feed
        ]);
    }

}