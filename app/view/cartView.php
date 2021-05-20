<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
$this->title = "Panier - Algobreizh";
/* var_dump($product_cart); */
?>

    <?php if (empty($_SESSION['cart'])) : ?>
        <div class="container-fluid mt-100">
            <div class="row">
                <div class="col-md-12">
                    <div class="card empty-cart">
                        <div class="card-body cart empty-cart-body">
                            <div class="col-sm-12 empty-cart-cls text-center"><i class="fas fa-cart-arrow-down fa-5x" class="img-fluid mb-4 mr-3"></i>
                                <h3><strong>Votre panier est vide</strong></h3>
                                <a href="index.php?action=shop" class="btn btn-success m-3">Retourner à la boutique</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div class="container">
        <div class="card shopping-cart">
                    <div class="card-header bg-dark text-light">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Mon panier
                        <a href="index.php?action=shop" class="btn btn-outline-success btn-sm pull-right">Continuer mes achats</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">

                        <?php foreach($product_cart as $item) : ?>
                            <!-- PRODUCT -->
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2 text-center">
                                        <?php echo '<img class="img-responsive" alt="preview" height="80" src="data:image/jpeg;base64,'.base64_encode($item['product_image']).'">';?>
                                </div>
                                <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                                    <h4 class="product-name"><strong><?= $item['product_name'] ?></strong></h4>
                                    <h4>
                                        <small>Product Description</small>
                                    </h4>
                                </div>
                                <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                                    <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                        <h6><strong><?= number_format($item['product_price'],2,',',' '); ?> €</strong></h6>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4">
                                        <div class="quantity">
                                            <input type="number" step="1" max="20" min="1" value="<?= $_SESSION['cart'][$item['product_id']]; ?>" title="Qty" class="qty"
                                                size="4">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 text-right">
                                        <a href="index.php?action=del-to-cart&productId=<?= $item['product_id'] ?>" class="btn btn-outline-danger btn-xs">
                                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- END PRODUCT -->
                            <?php endforeach; ?>

                        <div class="pull-right">
                            <a href="index.php?action=cart" class="btn btn-outline-secondary pull-right">
                                Mettre à jour le panier
                            </a>
                        </div>
                        <div class="pull-left">
                            <p>Nombre d'articles : <span> <?= $product_nb; ?> </span></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="coupon col-md-5 col-sm-5 no-padding-left pull-left">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Code coupon">
                                </div>
                                <div class="col-6">
                                    <input type="submit" class="btn btn-default" value="Utiliser un coupon">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right" style="margin: 10px">
                            <a href="index.php?action=checkout" class="btn btn-success pull-right">Payer</a>
                            <div class="pull-right" style="margin: 5px">
                                Prix total <b><?= number_format($total_price,2,',',' '); ?> €</b>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

     <?php endif; ?> 