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
    private $date;
    private $conn;
  
  public function __construct($nom,$prenom,$conn){
    $this->nom=$nom;
    $this->prenom=$prenom;
    $this->conn=$conn;
    $repetition=false;
    $stmt = $this->conn->prepare("INSERT INTO Artiste (nom,prenom) VALUES (:nom,:prenom)"); /*Requete pour inserer un artiste*/
    $requete_trie = "SELECT nom, prenom from Artiste where nom='".$nom."' and prenom='".$prenom."'";/*Requete pour verifier que lartiste nest pas deja dans la base de donnee*/
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

  
  
}


  
  class Album {
      private $album;
      private $date;
    
      public function __construct($album, $date, $nom, $prenom, $conn){
      $this->album = $album;
      $this->date = $date;  
      $repetition=false;
      $stmt2 = $conn->prepare("INSERT INTO Album (numArtiste,titre,dateAlbum) VALUES (:numArtiste,:titre,:dateAlbum)");
      $query = $conn->query("SELECT idArtiste from Artiste where nom='".$nom."' and prenom ='".$prenom."'"); /*Requete pour inserer un album*/
      $requete_trie = "SELECT * from Artiste, Album where idArtiste=numArtiste"; /*Requete pour verifier que lalbum nest pas deja dans la base de donnee*/
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      $numArt = $resultat['idArtiste'];
      $stmt2->bindParam(":numArtiste", $numArt);
      $stmt2->bindParam(":titre", $album);
      $stmt2->bindParam(":dateAlbum", $date);
      foreach($conn->query($requete_trie) as $trie){
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

  class Utilisateur {
    private $email;
    private $nom;
    private $prenom;
    private $mdp;
    
    public function __construct($email, $nom, $prenom, $mdp, $conn){
      $this->nom=$nom;
      $this->prenom=$prenom;
      $this->mdp=$mdp;
      $this->email=$email;
      
      $repetition=false;
      $stmt2 = $conn->prepare("INSERT INTO Utilisateur (email,nom,prenom,mdp) VALUES (:email,:nom,:prenom,:mdp)");
      $requete_trie = "SELECT * from Utilisateur where email='".$email."'";
      $stmt2->bindParam(":nom", $nom);
      $stmt2->bindParam(":prenom", $prenom);
      $stmt2->bindParam(":email", $email);
      $stmt2->bindParam(":mdp", $mdp);
      foreach($conn->query($requete_trie) as $trie){
          if($trie['email'] == $email) {
            $repetition = true;
            break;
          }
        }
      if($repetition == false){
        $stmt2->execute();
        echo "Vous avez ete enregistre avec succes.";
      }
      else
        echo "L'utilisateur est deja enregistre.";

      }
    
    
    public function seConnecter($conn, $email, $mdp){
      $utilisateur=false;
      $query = "SELECT * from Utilisateur where email='".$email."' and mdp='".$mdp."'";
      $idUtilisateur = "SELECT idUtilisateur from Utilisateur where email='".$email."' and mdp='".$mdp."'";;
      foreach($conn->query($query) as $trie){
          if($trie['email'] == $email && $trie['mdp'] == $mdp) {
            $utilisateur = true;
            break;
          }
        }
      if($utilisateur){
        echo "Bienvenue ".$trie['nom']." ".$trie['prenom'].".";
      }
      else
        echo "Authentification invalide.";
      
    }
    
    public function getListeNote($email, $conn){
      $query = "SELECT * from Album, Utilisateur, Note where idAlbum=numAlbum and idUtilisateur=numUtilisateur and email='".$email."' ";
      foreach($conn->query($query) as $trie){
          echo "Note :".$trie['note']." Album :".$trie['titre']."<br>";
        }
    }
    
    public function getListeCommentaires($email){
      
    }
    
      
    }

    


?>