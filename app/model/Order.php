<?php
require_once 'model/Model.php';

class Order extends Model {

    public function getOrderById($order_id) {
        $sql = 'SELECT o.order_id, o.order_date, o.order_status, o.first_name, o.last_name, o.order_address, o.order_city, o.order_country, p.product_name, i.quantity, p.product_price, p.product_image 
        FROM orders o INNER JOIN order_items i ON i.order_id = o.order_id INNER JOIN products p ON i.product_id = p.product_id 
        WHERE o.order_id = ?';
        $order = $this->executeRequest($sql, [$order_id]);
        $order = $order->fetch();
        return $order;
    }

    public function getOrdersByUser($user_id) {
        $sql = 'SELECT o.order_id, o.order_date, o.order_price, o.order_status, o.first_name, o.last_name, o.order_address, o.order_city, o.order_country
        FROM orders AS o INNER JOIN users u ON o.user_id = u.user_id 
        WHERE u.user_id = ?
        ORDER BY o.order_id DESC';
        $orders = $this->executeRequest($sql, $user_id);
        $orders = $orders->fetchAll();
        return $orders;
    }

    public function registerOrder($id_user, $order_price, $first_name, $last_name, $address, $country, $city) {
        $sql = 'INSERT INTO orders (user_id, order_date, order_price, first_name, last_name, order_address, order_city, order_country) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?)';
        $this->executeRequest($sql, [$id_user, $order_price, $first_name, $last_name, $address, $city, $country]);
    }

    public function registerOrderItem($id_order, $id_product, $quantity, $price) {
        $sql = 'INSERT INTO order_items (order_id, product_id, quantity, list_price) VALUES (?, ?, ?, ?)';
        $this->executeRequest($sql, [$id_order, $id_product, $quantity, $price]);
    }

    public function lastInsertId() {
        $lastId = $this->lastInsert();
        return $lastId;
    }

    public function getOrderUnprocessed() {
        $sql = 'SELECT o.order_id, o.order_date, u.username, o.first_name, o.last_name, o.order_address, o.order_city, o.order_country, o.order_price 
                FROM orders AS o INNER JOIN users AS U ON (o.user_id = u.user_id)
                WHERE order_status = 0';
        $orders = $this->executeRequest($sql);
        $orders = $orders->fetchAll();
        return $orders;
    }

    public function setOrderStatus($order_id) {
        $sql = 'UPDATE orders SET order_status = 1 WHERE order_id = ?';
        $this->executeRequest($sql, [$order_id]);
    }
}