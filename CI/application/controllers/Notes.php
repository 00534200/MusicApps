
<?php
  
  class Notes extends CI_Controller{
  
    public function liste($id){  
      $this->load->model('utilisateur');
      $this->utilisateur->getListeNote($id);
    }
  }

?> 
    