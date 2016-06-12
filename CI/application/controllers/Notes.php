
<?php
  session_start();
  class Notes extends CI_Controller{
    public function index(){
      $data['value']=$_SESSION["info_album"];
      $this->load->view('info_album',$data);
    }
    
    public function liste($id){  
      $this->load->model('utilisateur');
      $this->utilisateur->getListeNote($id);
    }
    
    public function ajouter($titre){
      extract($_GET);
      $this->load->model('model_album');
      if($note >=0 && $note <=10)
      $this->model_album->insererNote($note, $titre, $_SESSION['email']);
      $this->load->helper('url');
      redirect('notes');
    }
  }

?> 
    