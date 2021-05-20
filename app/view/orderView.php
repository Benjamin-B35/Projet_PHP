<?php
if(!isset($_SESSION)) {
    session_start();
}
$this->title = "Mes commandes - Algobreizh";

?>

<script src="https://kit.fontawesome.com/cc9d17069b.js" crossorigin="anonymous"></script>

<div class="container my-5">
    <h2 class="text-center my-5">Mes commandes</h2>
    <table class="table table-responsive text-center">
        <thead>
            <tr class="bg-success fw-bold text-white">
                <td>N°</td>
                <td>Date</td>
                <td>Contact</td>
                <td>Adresse</td>
                <td>Prix</td>
                <td>Statut</td>
                <td></td>
            </tr>
        </thead>

        <?php
        foreach($orders as $order) :
        ?>
        <tbody>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= $order['order_date'] ?></td>
                <td><?= $order['last_name'] ?> <?= $order['first_name'] ?></td>
                <td><?= $order['order_address'] . ', ' . $order['order_city'] . ', ' . $order['order_country'] ?></td>
                <td><?= number_format($order['order_price'],2,',',' ') ?> €</td>
                <td><?php if($order['order_status'] == 0){ echo "<i class='fas fa-hourglass-half text-warning'></i> En attente de validation..."; } else { echo "<i class='fas fa-check-circle text-success'></i> Validé";} ?></td>
                <td><i class="fas fa-info-circle text-warning"></i> <?php if($order['order_status'] == 1){ echo "<i class='fas fa-file-invoice-dollar text-success'></i>";} ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


