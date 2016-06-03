
    <?php
      include ('index.php');
      $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
      $conn = $init->seConnecter();
      extract($_GET);
      $liste = Utilisateur::getListeNote($email, $conn);
    ?> 
    