<h2 class="page-title">CONNEXION</h2>
        <?php
            if($error == "true"){
                echo '<p class="error">Erreur de connexion</p>';
            }
            require_once("vues/form-login.html"); 
            ?>
