<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
    <link rel="stylesheet" href="../assets/css/signin.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cc9d17069b.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/c560c025cf.js"></script>
  </head>
  <body>
    
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href=""><img src="../assets/img/logo-nav" height="35"> Algobreizh</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?= $navbar; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container bg_light">
        <?php if(isset($_SESSION['flash'])) : ?>
            <?php foreach($_SESSION['flash'] as $type => $message) : ?>
                <div class="alert alert-<?= $type ?>">
                    <?= $message ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>        
    </div>
    
    <!-- #content -->
    <?= $content ?>

    <footer>
    </footer>

    </body>
</html>