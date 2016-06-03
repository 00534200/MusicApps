
    <?php
      include ('index.php');
      $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
      $conn = $init->seConnecter();
      if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['mdp1'])) {
      extract($_POST);
      if($mdp == $mdp1){
        $util = new Utilisateur($email, $nom, $prenom, $mdp, $conn);
      }
      else
        echo "Confirmation du mot de passe invalide.";
      }
      else
        echo "Tous les champs sont obligatoires."
    ?> 