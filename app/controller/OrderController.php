<?php

require_once 'view/View.php';
require_once 'model/Order.php';

class OrderController {

    private $order;

    public function __construct() {
        $this->order = new Order();
    }

    public function order($user_id) {
        $orders = $this->order->getOrdersByUser($user_id);
        $view = new View("order");
        $view->generate(array('orders' => $orders));
    }
}
