
 <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
    class Rechercher extends CI_Controller {
      public function index(){
       $this->load->view('afficher_recherches'); 
      }   
    }
    
?>