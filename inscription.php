
    <?php
      include ('index.php');
      $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
      $conn = $init->seConnecter();
      $champ_vide = false;
      $email_valide = false;
      extract($_POST);
      foreach($_POST as $var){
        if($var =='' && $var != $Submit)
          $champ_vide=true;
      }
      for($i=0; $i < strlen($email); $i++){
        if($email[$i] == '@')
          $email_valide = true;
      }
      if($champ_vide == false && $email_valide == true && $mdp == $mdp1 && strlen($nom) >1 && strlen($prenom)>1){
        $util = new Utilisateur($email, $nom, $prenom, $mdp, $conn);
      }
      if($champ_vide ==true)
        echo "Tous les champs sont obligatoires.<br>";
      if(strlen($nom) <=1 || strlen($prenom)<=1)
        echo "Entrez un nom et un prenom valide.<br>";
      if($email_valide == false)
        echo "Entrez une adresse mail valide.<br>";
      if($mdp != $mdp1)
      echo "Confirmation du mot de passe invalide.";
          
    ?> 
    