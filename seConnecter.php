<?php
      include ('index.php');
      $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
      $conn = $init->seConnecter();
      if(isset($_POST['email']) && isset($_POST['mdp'])) {
      extract($_POST);
      $util = Utilisateur::seConnecter($conn, $email, $mdp);
      }
      else
        echo "Tous les champs sont obligatoires."
    ?> 