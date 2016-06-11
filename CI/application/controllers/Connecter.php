<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
  class Connecter extends CI_Controller {
    public function index(){
      if(isset($_SESSION['email']) && isset($_SESSION['etat_conn']))
        $this->load->view('afficher_recherches');
      else { 
        $this->load->view('formulaire_connexion');
      }  
    }

    public function traitement(){  
    if(isset($_POST['email']) && isset($_POST['mdp'])) {
      extract($_POST);
      $this->load->model('utilisateur');
      $this->utilisateur->seConnecter($email, $mdp);
      $this->load->helper('url');
      redirect('connecter');
    }
    else
      echo "Tous les champs sont obligatoires.";

    }
  }


?> 