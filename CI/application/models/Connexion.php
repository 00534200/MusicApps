<?php
class Connexion extends CI_Model {
  
  private $hostname='dwarves.iut-fbleau.fr';
	private $username='reilhac';
	private $password='toto';
	private $database='reilhac';
  private $db;
  
  public function __construct(){

    $conn = NULL;

        try{
            $conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage();
                }    
            $this->db = $conn;
    }
    
    public function getConnection(){
        return $conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);;
    }
}

?>