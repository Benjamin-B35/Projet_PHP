<?php

require_once 'controller/SignUpController.php';
require_once 'controller/LoginController.php';
require_once 'controller/ShopController.php';
require_once 'controller/AdminHomeController.php';
require_once 'controller/CartController.php';
require_once 'controller/OrderController.php';
require_once 'controller/CheckoutController.php';
require_once 'view/View.php';

class Router {

    private $signUpCtrl;
    private $loginCtrl;
    private $shopCtrl;
    private $adminHomeCtrl;
    private $cartCtrl;
    private $orderCtrl;
    private $checkoutCtrl;

    public function __construct() {
        $this->signUpCtrl = new SignUpController();
        $this->loginCtrl = new LoginController();
        $this->shopCtrl = new ShopController();
        $this->adminHomeCtrl = new AdminHomeController();
        $this->cartCtrl = new CartController();
        $this->orderCtrl = new OrderController();
        $this->checkoutCtrl = new CheckoutController();
    }

    // Route une requête entrante : exécution l'action associée
    public function routeRequest() {
        /* try { */
            if (isset($_GET['action'])) {
                switch($_GET['action']) {
                    case 'sign-up' :
                        $this->signUpCtrl->signUp();
                        break;
                    case 'valid-sign-up' :
                        $username = $this->getParam($_POST, 'username');
                        $email = $this->getParam($_POST, 'email');
                        $firstName = $this->getParam($_POST, 'first_name');
                        $lastName = $this->getParam($_POST, 'last_name');
                        $city = $this->getParam($_POST, 'city');
                        $password = $this->getParam($_POST, 'password');
                        $passwordConfirm = $this->getParam($_POST, 'passwordConfirm');
                        $this->signUpCtrl->checkForm($username, $email, $firstName, $lastName, $city, $password, $passwordConfirm);
                        break;
                    case 'login' :
                        $this->loginCtrl->login(); 
                        break;
                    case 'valid-login' :
                        $email = $this->getParam($_POST, 'email');
                        $password = $this->getParam($_POST, 'password');
                        $this->loginCtrl->checkLogin($email, $password);
                        break;
                    case 'confirm' :
                        $id = $this->getParam($_GET, 'id');
                        $token = $this->getParam($_GET, 'token');
                        $this->signUpCtrl->checkToken($id, $token);
                        break;
                    case 'shop' :
                        if(isset($_GET['category'])) {
                            $category = $this->getParam($_GET, 'category');
                            $this->shopCtrl->shop($category);
                        } else {
                            $this->shopCtrl->shop(0);
                        }
                        break;
                    case 'admin-home' :
                        $this->adminHomeCtrl->adminHome();
                        break;
                    case 'valid-order' :
                        $order_id = $this->getParam($_GET, 'id');
                        $this->adminHomeCtrl->validOrder($order_id);
                        break;
                    case 'logout' :
                        unset($_SESSION['user_id']);
                        session_destroy();
                        $this->loginCtrl->login();
                        break;
                    case 'cart' :
                        $this->cartCtrl->cart();
                        break;
                    case 'add-to-cart' :
                        $product_id = $this->getParam($_GET, 'productId');
                        $this->cartCtrl->add($product_id);
                        break;
                    case 'del-to-cart' :
                        $product_id = $this->getParam($_GET, 'productId');
                        $this->cartCtrl->del($product_id);
                        break;
                    case 'order' :
                        $user_id = $this->getParam($_SESSION, 'user_id');
                        $this->orderCtrl->order([$user_id]);
                        break;
                    case 'checkout' :
                        $this->checkoutCtrl->checkout();
                        break;
                    case 'valid-checkout' :
                        $user_id = $this->getParam($_SESSION, 'user_id');
                        $first_name = $this->getParam($_POST, 'firstName');
                        $last_name = $this->getParam($_POST, 'lastName');
                        $address = $this->getParam($_POST, 'address');
                        $country = $this->getParam($_POST, 'country');
                        $city = $this->getParam($_POST, 'city');
                        $this->checkoutCtrl->checkForm($user_id, $first_name, $last_name, $address, $country, $city);
                    default :
                        $this->shopCtrl->shop(0);
                }
            }
            else {  // aucune action définie : affichage de la boutique ou de la page d'inscription
                if (isset($_SESSION['role'])) {
                    if($_SESSION['role'] == 'customer') {
                        $this->shopCtrl->shop(0);
                    } else {
                        $this->adminHomeCtrl->adminHome();
                    }
                }
                else {
                    $this->loginCtrl->login();
                }
            }
        /* }
        catch (Exception $e) {
            $this->error($e->getMessage());
        } */
    }

    // Affiche une erreur
    private function error($msgErreur) {
        $vue = new View("error");
        $vue->generate(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParam($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}
