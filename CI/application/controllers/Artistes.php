 <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Artistes extends CI_Controller {
    
    public function index(){
      $this->load->view('afficher_artistes');
    }
    
    public function traitement(){
      if(isset($_GET['nom']) && isset($_GET['prenom']) && $_GET['prenom'] != null && $_GET['nom'] != null){
        extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
        $date_str =(string)$date;
        $this->load->model('model_artiste');
        $this->model_artiste->inserer($nom,$prenom);
      }
       if(isset($_GET['album']) && $_GET['album'] != null){
           extract($_GET); 
           if($date != null && $genre != null){
               if($date>=1800 && $date<=date("Y")){
                 $id_number=(int) $idArtiste;
                 $this->load->model('model_album');
                 $this->model_album->inserer($date, $genre,$album, $id_number);
               }
            }
         }
          $this->load->helper('url');
          redirect('artistes');
    }
  }  
?>