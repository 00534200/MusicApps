<?php
class Connexion extends PDO {
  private $servername;
  private $username;
  private $dbname;
  private $password;
  
  public function __construct($servername,$username,$dbname,$password){
    $this->servername=$servername;
    $this->username=$username;
    $this->dbname=$dbname;
    $this->password=$password;
  }
  
  public function seConnecter(){
    return new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
  }
}
?>