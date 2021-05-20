<?php
require_once 'model/Model.php';

class Product extends Model {

    public function getProducts() {
        $sql = "SELECT * FROM products";
        $products = $this->executeRequest($sql);
        $products = $products->fetchAll();
        return $products;
    }

    public function getProductsByIdCategory($idCategory) {
        $sql = "SELECT * FROM products WHERE category_id = ? ";
        $products = $this->executeRequest($sql, array($idCategory));
        $products = $products->fetchAll();
        return $products;
    }

    public function getProductCart($id) {
        $sql = "SELECT * FROM products WHERE product_id IN ($id)";
        $ids = $this->executeRequest($sql, []);
        $ids = $ids->fetchAll();
        return $ids;
    }
}