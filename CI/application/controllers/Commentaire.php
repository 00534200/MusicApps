
<?php
  session_start();
  class Commentaire extends CI_Controller{
    public function index(){
      $data['value']=$_SESSION["info_album"];
      $this->load->view('info_album',$data);
    }

    
    public function ajouter($titre){
      extract($_GET);
      $this->load->model('model_album');
      $this->model_album->insererCom($com, $titre, $_SESSION['email']);
      $this->load->helper('url');
      redirect('commentaire');
    }
  }

?> 