<?php

require_once 'view/View.php';
require_once 'model/Order.php';
require_once 'model/User.php';
require_once 'controller/CartController.php';
require_once 'controller/ShopController.php';

class CheckoutController {

    private $order;
    private $user;
    private $cartCtrl;
    private $shopCtrl;

    public function __construct() {
        $this->order = new Order();
        $this->user = new User();
        $this->cartCtrl = new CartController();
        $this->shopCtrl = new ShopController();
    }

    public function checkout() {
        $product_cart = $this->cartCtrl->getProductCart();
        $total_price = $this->cartCtrl->totalPrice();
        $product_nb = $this->cartCtrl->count();
        $user_id = $this->user->getUserbyId($_SESSION['user_id']);
        $view = new View("checkout");
        $view->generate(array('cart' => $_SESSION['cart'],
                            'total_price' => $total_price,
                            'product_cart' => $product_cart,
                            'product_nb' => $product_nb,
                            'user_id' => $user_id    
                        ));
    }

    public function checkForm($user_id, $first_name, $last_name, $address, $country, $city) {
        if(!empty($_POST)) {
            $order_price = $this->cartCtrl->totalPrice();
            $this->order->registerOrder($user_id, $order_price, $first_name, $last_name, $address, $country, $city);
            $order_id = $this->order->lastInsertId();
            $products = $this->cartCtrl->getProductCart();
            foreach($products as $product) {
                $product_id = $product['product_id'];
                $quantity = $_SESSION['cart'][$product['product_id']];
                $price = $product['product_price'];
                $this->order->registerOrderItem($order_id, $product_id, $quantity, $price);
            }
            unset($_SESSION['cart']);
            $_SESSION['flash']['success'] = "Votre commande à été envoyé, elle sera traitée sous 48h";
            $this->shopCtrl->shop(0);
        
        } else {
            $_SESSION['flash']['danger'] = "Veuillez compléter tous les champs";
            $this->checkout();
        }
    }
}