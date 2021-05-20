<?php
require_once 'view/View.php';
require_once 'model/User.php';
require_once 'controller/ShopController.php';
require_once 'controller/AdminHomeController.php';

class LoginController {

    private $user;
    private $shopCtrl;
    private $adminHomeCtrl;
    
    public function __construct() {
        $this->user = new User();
        $this->shopCtrl = new ShopController();
        $this->adminHomeCtrl = new AdminHomeController();
    }

    public function checkLogin($email, $password) {
        $user = $this->user->getUserByEmail($email);
        $hash = $user['password'];
        if($hash && password_verify($password, $hash)) {
            $role = $user['role'];
            $user_id = $user['user_id'];
            if(!isset($_SESSION)) {
                session_start();
            }
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role; 
                $_SESSION['loggedIn'] = true;
            if($_SESSION['role'] == 'customer') {                        
                $this->shopCtrl->shop();
            } else {
                $this->adminHomeCtrl->adminHome();
            }
        } else {
            $_SESSION['flash']['danger'] = "Mot de passe incorrect";
            $this->login();
        }
    }

    public function login() {
        $view = new View("login");
        $view->generate(array());
    }
}