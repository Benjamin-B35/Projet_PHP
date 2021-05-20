<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
  $this->title = "Espace admin - Algobreizh";
?>

<div class="container my-5">
    <h2 class="text-center my-5">Tableau de bord</h2>
    <table class="table table-responsive text-center">
        <thead>
            <tr class="bg-success fw-bold text-white">
                <td>Date</td>
                <td>N°</td>
                <td>Société</td>
                <td>Contact</td>
                <td>Adresse</td>
                <td>Prix</td>
                <td>Action</td>
            </tr>
        </thead>

        <?php
        foreach($orders as $order) :
        ?>
        <tbody>
            <tr>
                <td><?= $order['order_date'] ?></td>
                <td><?= $order['order_id'] ?></td>
                <td><?= $order['username'] ?></td>
                <td><?= $order['first_name'] . ' ' . $order['last_name'] ?></td>
                <td><?= $order['order_address'] . ', ' . $order['order_city'] . ', ' . $order['order_country'] ?></td>
                <td><?= $order['order_price'] ?></td>
                <td><a href="index.php?action=valid-order&id=<?= $order['order_id'] ?>"><i class="far fa-check-circle text-success"></i></a></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>