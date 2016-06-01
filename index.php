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

class Artiste {
    private $nom;
    private $prenom;
    private $conn;
  
  public function __construct($nom,$prenom,$conn){
    $this->nom=$nom;
    $this->prenom=$prenom;
    $this->conn=$conn;
  }
  
  public function getNom(){
    return $this->nom;
  }
  
  public function getPrenom(){
    return $this->prenom;
  }
  
  public function insererArtiste($nom, $prenom){
    $repetition=false;
    $stmt = $this->conn->prepare("INSERT INTO Artiste (nom,prenom) VALUES (:nom,:prenom)"); /*Requete pour inserer un artiste*/
    $requete_trie = "SELECT nom, prenom from Artiste where nom='".$this->nom."' and prenom='".$this->prenom."'";/*Requete pour verifier que lartiste nest pas deja dans la base de donnee*/
    if(!$stmt) die ("pb");
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom); 

    foreach($this->conn->query($requete_trie) as $trie){
          if($trie['nom'] == $nom && $trie['prenom'] == $prenom) {
            $repetition = true;
            break;
          }
        }
    if($repetition == false) {
      $stmt->execute();
      echo "L'artiste a ete enregistre avec succes.";
    }
    else
      echo "L'artiste est deja enregistre.<br>";

  }
  
  public function insererAlbum($album){
      $repetition=false;
      $stmt2 = $this->conn->prepare("INSERT INTO Album (numArtiste,titre) VALUES (:numArtiste,:titre)");
      $query = $this->conn->query("SELECT idArtiste from Artiste where nom='".$this->nom."' and prenom ='".$this->prenom."'"); /*Requete pour inserer un album*/
      $requete_trie = "SELECT * from Artiste, Album where idArtiste=numArtiste"; /*Requete pour verifier que lalbum nest pas deja dans la base de donnee*/
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      $numArt = $resultat['idArtiste'];
      $stmt2->bindParam(":numArtiste", $numArt);
      $stmt2->bindParam(":titre", $album);
      foreach($this->conn->query($requete_trie) as $trie){
          if($trie['titre'] == $album) {
            $repetition = true;
            break;
          }
        }
      if($repetition == false){
        $stmt2->execute();
        echo "L'album a ete enregistre avec succes.";
      }
      else
        echo "L'album est deja enregistre.";

  }
  
  
}
?>