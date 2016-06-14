
 <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
    class Rechercher extends CI_Controller {
      public function index(){
       session_start();
       if(isset($_SESSION['search']))
        $this->load->view($_SESSION['search']);
        else
         $this->load->view("afficher_recherches");
      } 
      
      public function album(){
        session_start();
        $_SESSION['search'] = 'afficher_recherches_album'; 
        $this->load->helper('url');
        redirect('rechercher');
      }
      
      public function user(){
        session_start();
        $_SESSION['search'] = 'afficher_recherches'; 
        $this->load->helper('url');
        redirect('rechercher');
      }
    }
    
?>