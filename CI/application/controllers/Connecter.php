<?php
defined('BASEPATH') OR exit('No direct script access allowed');
      class Connecter extends CI_Controller {
       
        
        public function index(){
          $this->load->view('formulaire_connexion');
        }  

        public function traitement(){  
        if(isset($_POST['email']) && isset($_POST['mdp'])) {
          extract($_POST);
          $this->load->model('utilisateur');
          $this->utilisateur->seConnecter($email, $mdp);
        }
        else
          echo "Tous les champs sont obligatoires.";

        }
      }


?> 