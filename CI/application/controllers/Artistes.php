 <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Artistes extends CI_Controller {
    
    public function index(){
      $this->load->view('afficher_artistes');
    }
    
    public function traitement(){
    if(isset($_GET['nom']) && isset($_GET['prenom']) && $_GET['prenom'] != null && $_GET['nom'] != null  ){
        extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
        $this->load->model('model_artiste');
        $this->model_artiste->inserer($nom,$prenom);
         if(isset($_GET['album']) && $_GET['album'] != null){
           $this->load->model('model_album');
           $this->model_album->inserer($album, $nom, $prenom);
         }
        }
      }
    
 

  }  
?>