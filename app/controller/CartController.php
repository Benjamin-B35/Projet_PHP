<?php

require_once 'view/View.php';
require_once 'model/User.php';
require_once 'model/Product.php';
require_once 'controller/ShopController.php';

class CartController {

    private $product;
    private $shopCtrl;


    public function __construct() {
        $this->product = new Product();
        $this->shopCtrl = new ShopController();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
    }

    public function cart() {
        $product_cart = $this->getProductCart();
        $total_price = $this->totalPrice();
        $product_nb = $this->count();
        $view = new View("cart");
        $view->generate(array('cart' => $_SESSION['cart'], 'total_price' => $total_price, 'product_cart' => $product_cart, 'product_nb' => $product_nb));
    }

    public function totalPrice() {
        $total = 0;
        $products = $this->getProductCart();
        foreach($products as $product) {
            $total += $product['product_price'] * $_SESSION['cart'][$product['product_id']];
        }
        return $total;
    }

    public function getProductCart() {
        $ids = array_keys($_SESSION['cart']);
        $ids_implode = implode(",", $ids);
        if(empty($ids)) {
            $products = [];
        } else {
            $products = $this->product->getProductCart($ids_implode);
        }
        return $products;
    }

    public function add($product_id) {
        if(isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }
        $this->shopCtrl->shop(0);  
    }

    public function del($product_id) {
        unset($_SESSION['cart'][$product_id]);
        $this->cart(); 
    }

    public function count() {
        return array_sum($_SESSION['cart']);
    } 
}