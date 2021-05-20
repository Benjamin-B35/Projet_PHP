<?php $this->title = "Inscription - Algobreizh"; ?>

<?php if(!empty($this->signUpCtrl->errors)) : ?>
    <div class="alert alert-danger py-2">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
        <?php foreach($this->errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="signup text-center">    
        <main class="form-signup">
        <form method="POST" action="index.php?action=valid-sign-up">
            <img class="mb-4" src="../assets/img/logo-nav.svg" alt="" width="" height="110">
            <h1 class="h3 mb-3 fw-normal">Inscription</h1>
            <label for="inputUsername" class="visually-hidden">Nom de la société</label>
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Nom d'utilisateur">
            <label for="inputEmail" class="visually-hidden">Adresse email</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse email">
            <label for="inputFirstName" class="visually-hidden">Prénom du conatact</label>
                <input type="text" name="first_name" id="inputFirstName" class="form-control" placeholder="Prénom du contact">
            <label for="inputLastName" class="visually-hidden">Nom du contact</label>
                <input type="text" name="last_name" id="inputLastName" class="form-control" placeholder="Nom du contact">
            <label for="inputCity" class="visually-hidden">Ville</label>
                <select type="text" name="city" id="inputCity" class="form-select" placeholder="Ville" aria-label="Default select example">
                    <option selected>Choisissez votre ville</option>
                <?php foreach($cities AS $city) : ?>
                    <option><?= $city['city_name'] ?></option>
                <?php endforeach ?>
                </select>
            <label for="inputPassword" class="visually-hidden">Mot de passe</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe">
            <label for="inputPasswordConfirm" class="visually-hidden">Valider le mot de passe</label>
                <input type="password" name="passwordConfirm" id="inputPasswordConfirm" class="form-control" placeholder="Valider le mot de passe">
            <button class="w-100 btn btn-lg btn-success" type="submit" name="sign-up">S'inscrire</button>
        </form>
        </main>
    </div>