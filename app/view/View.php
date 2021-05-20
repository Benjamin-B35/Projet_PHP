<?php

if(!isset($_SESSION)) {
    session_start();
}

class View {

    // Nom du fichier associé à la vue
    private $file;
    
    // Titre de la vue (défini dans le fichier vue)
    private $title;

    public function __construct($action) {
        // Détermination du nom du fichier vue à partir de l'action
        $this->file = "view/" . $action . "View.php";
    }

    // Génère et affiche la vue
    public function generate($data) {
        // Génération de la partie spécifique de la vue
        $content = $this->generateFile($this->file, $data);
        // Génération du gabarit commun utilisant la partie spécifique
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['role'] == 'admin') {
                $navbar = " <li class='nav-item'>
                                <a class='btn btn-outline-danger' href='index.php?action=logout' type='button'>Se déconnecter</a>
                            </li>";
            } else {
                $navbar =   "<li class='nav-item'>
                                <a class='nav-link' href='index.php?action=shop'><i class='fas fa-store'></i> Boutique</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='index.php?action=order'><i class='fas fa-file-invoice-dollar'></i> Mes commandes</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='index.php?action=cart'><i class='fas fa-shopping-cart'></i> Panier</a>
                            </li>
                            <li class='nav-item'>
                            <a class='btn btn-outline-danger' href='index.php?action=logout' type='button'>Se déconnecter</a>
                            </li>";
            }
        } else {
            $navbar =   "<li class='nav-item'>
                            <a class='nav-link' href='index.php?action=login'>Se connecter</a>
                        </li>
                        <li class='nav-item'>
                            
                            <a class='btn btn-outline-success' type='button' href='index.php?action=sign-up'>S'inscrire</a>
                        </li>";
                        
        }


        $view = $this->generateFile('view/template.php',
                array('title' => $this->title, 'content' => $content, 'navbar' => $navbar));
        // Renvoi de la vue au navigateur
        echo $view;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function generateFile($file, $data) {
        if (file_exists($file)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($data);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $file;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$file' introuvable");
        }
    }

}