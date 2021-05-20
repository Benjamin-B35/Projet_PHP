<?php
require_once 'view/View.php';
require_once 'model/Order.php';

class AdminHomeController {

    private $order;

    public function __construct() {
        $this->order = new Order();
    }

    public function adminHome() {
        $orders = $this->order->getOrderUnprocessed();
        $view = new View("adminHome");
        $view->generate(array('orders' => $orders));
    }

    public function validOrder($order_id) {
        $this->order->setOrderStatus($order_id);
        $this->adminHome();
    }
}