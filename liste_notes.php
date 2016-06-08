
    <?php
      include ('CI/application/models/model.php');
      $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
      $conn = $init->seConnecter();
      extract($_GET);
      $this->load->model('utilisateur');
      $this->utilisateur->getListeNote($email);
    ?> 
    