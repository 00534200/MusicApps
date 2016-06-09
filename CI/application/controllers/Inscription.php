
    <?php
      defined('BASEPATH') OR exit('No direct script access allowed');

      class Inscription extends CI_Controller {
        
        public function index(){
          $this->load->view('formulaire_inscription');
          
        }
        
        public function traitement(){
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
          $this->load->model('utilisateur');
          $this->utilisateur->inserer($email, $nom, $prenom, $mdp);
          $this->load->helper('url');
          redirect('connecter');
        }
        if($champ_vide ==true)
          echo "Tous les champs sont obligatoires.<br>";
        if(strlen($nom) <=1 || strlen($prenom)<=1)
          echo "Entrez un nom et un prenom valide.<br>";
        if($email_valide == false)
          echo "Entrez une adresse mail valide.<br>";
        if($mdp != $mdp1)
        echo "Confirmation du mot de passe invalide.";
        }
      }
    ?> 
    