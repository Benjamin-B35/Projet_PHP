<?php $this->title = 'Boutique - Algobreizh';
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
  ?>

<div class="container py-5">
  <div class="row">
    <div class="col-lg-3">
      <h1 class="my-4 text-center">Boutique</h1>
      <div class="list-group">
        <a href="index.php?action=shop" class="list-group-item text-dark">Tous</a>
          <?php foreach($categories as $category) : ?>
            <a href="index.php?action=shop&category=<?= $category['category_id'] ?>" class="list-group-item text-dark"><?= $category['category_name'] ?></a>
          <?php endforeach; ?>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row my-5">
        <?php      
        foreach($products as $product) : ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#">
                  <?php echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($product['product_image']).'">';?>
                </a>
              <div class="card-body text-center">
                <h4 class="card-title"><?= $product['product_name'] ?></h4>
                <h5><?= number_format($product['product_price'],2,',',' '); ?> €</h5>
                <a href="index.php?action=add-to-cart&productId=<?= $product['product_id'] ?>" class="btn btn-success addPanier"><i class="fas fa-cart-plus"></i> Ajouter au panier</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>