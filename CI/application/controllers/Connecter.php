<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
  class Connecter extends CI_Controller {
    public function index(){
      if(isset($_SESSION['email']) && isset($_SESSION['etat_conn']))
        $this->load->view('afficher_accueil');
      else {
        $data['connexion'] = true;  
        if(isset($_SESSION['connexion'])){
          $data['connexion'] = $_SESSION['connexion'];  
          $_SESSION['connexion']=true;
        }  
        $this->load->view('formulaire_connexion',$data);
      }
    }

    public function traitement(){  
      if(isset($_POST['email']) && isset($_POST['mdp'])) {
        extract($_POST);
        $this->load->model('utilisateur');
        $_SESSION['connexion']=$this->utilisateur->seConnecter($email, $mdp);
        $this->load->helper('url');
        redirect('connecter');

      }
    }
  }


?> 