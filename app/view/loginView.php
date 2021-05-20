<?php $this->title = "Connexion - Algobreizh" ?>

<?php
if(!empty($errors)) : ?>
    <div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
    <?php foreach($errors as $error) : ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="signin text-center">    
    <main class="form-signin">
        <form method="POST" action="index.php?action=valid-login">
            <img class="mb-4" src="../assets/img/logo-nav.svg" alt="" width="" height="110">
            <h1 class="h3 mb-3 fw-normal">Connexion</h1>
            <label for="inputEmail" class="visually-hidden">Email</label>
                <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email">
            <label for="inputPassword" class="visually-hidden">Mot de passe</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe">
            <button class="w-100 btn btn-lg btn-success" type="submit" name="login">Se connecter</button>
        </form>
    </main>
</div>