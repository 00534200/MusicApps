 <?php
  session_start();
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Album extends CI_Controller {
    public function index(){
      $data['value']=$_SESSION["info_album"];
      $this->load->view('info_album',$data);
    }
    
    public function info($id){
        $this->load->model('model_album');
        $info=$this->model_album->getInfo($id);
        $_SESSION["info_album"]=$info;
        $this->load->helper('url');
        redirect('album');
    }
    
 

  }  
?>