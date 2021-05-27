<?php
if(!isset($_SESSION)) {
    session_start();
}
$this->title = "Envoi commande - Algobreizh";
?>

<div class="container">
  <main>
    <div class="pb-5 text-center">
      <img class="d-block mx-auto mb-4" src="assets/img/logo-nav.svg" alt="" width="" height="80">
      <h2>Validation de votre commande</h2>
    </div>

    <div class="row g-3">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Votre panier</span>
          <span class="badge bg-secondary rounded-pill"><?= $product_nb; ?></span>
        </h4>
        <ul class="list-group mb-3">
        <?php foreach($product_cart as $item) : ?>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <p class="my-0"><?= $_SESSION['cart'][$item['product_id']] . 'x ' . $item['product_name'] ?></p>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted"><?= number_format($item['product_price'],2,',',' '); ?> €</span>
            </li>
          <?php endforeach ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total</span>
            <strong><?= number_format($total_price,2,',',' '); ?> €</strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Coordonnées</h4>
        <form method="POST" action="index.php?action=valid-checkout">
          <div class="row g-3">

            <div class="col-12">
              <label for="address" class="form-label">Nom de la société</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Algu'o Rythme" value="<?= $user_id['username'] ?>" disabled>
              <div class="invalid-feedback">
                Entrez une adresse de livraison
              </div>
            </div>

            <div class="col-sm-6">
              <label for="firstName" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Sébastien" value="<?= $user_id['contact_first_name'] ?>" required>
              <div class="invalid-feedback">
                Entrez votre prénom
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Nom</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Dupont" value="<?= $user_id['contact_last_name'] ?>" required>
              <div class="invalid-feedback">
                Entrez votre nom
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="16 rue des Clochers" required>
              <div class="invalid-feedback">
                Entrez une adresse de livraison
              </div>
            </div>

            <div class="col-sm-6">
              <label for="country" class="form-label">Pays</label>
              <select class="form-select" id="country" name="country" required>
                <option>France</option>
              </select>
              <div class="invalid-feedback">
                Sélectionnez un pays
              </div>
            </div>

            <div class="col-sm-6">
              <label for="city" class="form-label">Ville</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="Paris" value="" required>
              <div class="invalid-feedback">
                Entrez votre nom
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Paiement</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Carte bancaire</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Nom sur la carte</label>
              <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="DUPONT Sebastien" required>
              <small class="text-muted">Nom complet sur la carte</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Numéro de carte</label>
              <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="XXXX XXXX XXXX XX28" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Date d'expiration</label>
              <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="06/21" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="XX3" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit" name="validate">Envoyer commande</button>
        </form>
      </div>
    </div>
  </main>
