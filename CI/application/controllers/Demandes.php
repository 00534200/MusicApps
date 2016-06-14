 <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Demandes extends CI_Controller {
    
    public function index(){
      $this->load->view('afficher_demandes');
    }
    
    public function validation($id){
          $this->load->model('utilisateur');
          $this->utilisateur->valider($id);
          $this->load->helper('url');
          redirect('demandes');
    }
    
    public function refuser($id){
      $this->load->model('utilisateur');
      $this->utilisateur->refuser($id);
      $this->load->helper('url');
      redirect('demandes');
    }
    
 

  }  
?>