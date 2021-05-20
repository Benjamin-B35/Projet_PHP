<?php
require_once 'model/Model.php';

class Category extends Model {

    public function getCategories() {
        $sql = "SELECT * FROM categories";
        $cat = $this->executeRequest($sql);
        $cat = $cat->fetchAll();
        return $cat;
    }
}