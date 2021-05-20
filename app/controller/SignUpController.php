<?php
require_once 'view/View.php';
require_once 'model/User.php';
require_once 'controller/LoginController.php';
require_once 'model/City.php';

class SignUpController {

    private $user;
    private $loginCtrl;
    private $city;
    public $errors = [];

    public function __construct(){
        $this->user = new User();
        $this->loginCtrl = new LoginController();
        $this->city = new City();
    }

    public function checkForm($username, $email, $firstName, $lastName, $city, $password, $passwordConfirm) {
        $checkUser = $this->checkUsername($username);
        $checkEmail = $this->checkEmail($email);
        $checkPassword = $this->checkPassword($password, $passwordConfirm);
        if($checkUser == true AND $checkEmail == true AND $checkPassword == true) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $token = $this->generateToken(60);
            $code = $this->generateUserCode();
            $city = (int)$this->city->getCityIdByName($city);
            $this->user->createUser($code, $username, $firstName, $lastName, $city, $password, $email, $token);
            $user = $this->user->lastInsertId();
            $this->sendEmail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost/new_Algobreizh/app/index.php?action=confirm&id=$user&token=$token\n\nVotre code client : $code");
            $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";
            $this->loginCtrl->login();
        } else {
            echo 'Erreur';
            $this->signUp();

        }
    }

    public function signUp(){
        $cities = $this->city->getCities();
        $view = new View("signUp");
        $view->generate(array('cities' => $cities));
    }

    public function checkUsername($username){
        if(empty($username) || !preg_match('/^[a-zA-Z0-9_]/', $username)) {
            $_SESSION['flash']['danger'] = "Votre pseudo n'est pas valide";
            return false;
        } else {
            if($this->user->getIdByUsername($username)) {
                $_SESSION['flash']['danger'] = "Ce pseudo est déjà pris";
                return false;
            }
            return true;
        }
    }

    public function checkEmail($email){
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash']['danger'] = "Votre email n'est pas valide";
            return false;
        } else {
            if($this->user->getIdByEmail($email)) {
                $_SESSION['flash']['danger'] = "Cet email est déjà utilisé";
                return false;
            }
            return true;
        }  
    }

    public function checkPassword($password, $passwordConfirm) {
        if(empty($password) || $password != $passwordConfirm) {
            $_SESSION['flash']['danger'] = "Vous devez entrer un mot de passe valide";
            return false;
            echo 'mot de passe invalide';
        }
        return true;
    }

    public function generateUsercode() {
        $code = "0123456789";
        return substr(str_shuffle(str_repeat($code, 5)), 0, 5);
    }

    public function generateToken($length){
        $varchar = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        return substr(str_shuffle(str_repeat($varchar, $length)), 0, $length);
    }

    public function sendEmail($email, $subject, $message){
        return mail($email, $subject, $message);
    }

    public function checkToken($id, $token) {
    $validToken = $this->user->getTokenById($id);
    if($token == $validToken) {
        $this->user->setTokenById($id);
        $_SESSION['flash']['success'] = "Votre compte a été validé";
        $this->loginCtrl->login();
        }
    }
}