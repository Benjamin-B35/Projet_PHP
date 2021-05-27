<?php
require_once 'model/Product.php';
require_once 'model/Category.php';
require_once 'view/View.php';

class ShopController {

    private $product;
    private $category;

    public function __construct() {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function shop($category) {
        if ($category == 0) {
            $products = $this->product->getProducts();
        } else {
            $products = $this->product->getProductsByIdCategory($category);
        }
        $categories = $this->category->getCategories();       
        $view = new View("shop");
        $view->generate(array('categories' => $categories, 'products' => $products));
    }
}