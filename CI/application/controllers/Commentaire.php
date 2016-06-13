
<?php
  session_start();
  class Commentaire extends CI_Controller{
    public function index(){
      $data['value']=$_SESSION["info_album"];
      $this->load->view('info_album',$data);
    }

    
        }
    
    public function liste($id){  
      $this->load->model('utilisateur');
      $this->utilisateur->getListeCommentaire($id);
    }
    
    
    public function ajouter($titre){
      extract($_POST);
      $this->load->model('model_album');
      $this->model_album->insererCom($commentaire, $titre, $_SESSION['email']);
      $this->load->helper('url');
      redirect('commentaire');
    }
  }

?> 