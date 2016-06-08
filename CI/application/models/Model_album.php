<?php
  class Model_album extends CI_Model {
      private $album;
      private $date;
    
      public function inserer($album, $date, $nom, $prenom){
      $this->album = $album;
      $this->date = $date;  
      $repetition=false;
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $stmt = $conn->prepare("INSERT INTO Album (numArtiste,titre,dateAlbum) VALUES (:numArtiste,:titre,:dateAlbum)");
      $query = $conn->query("SELECT idArtiste from Artiste where nom='".$nom."' and prenom ='".$prenom."'"); /*Requete pour inserer un album*/
      $requete_trie = "SELECT * from Artiste, Album where idArtiste=numArtiste"; /*Requete pour verifier que lalbum nest pas deja dans la base de donnee*/
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      $numArt = $resultat['idArtiste'];
      $stmt->bindParam(":numArtiste", $numArt);
      $stmt->bindParam(":titre", $album);
      $stmt->bindParam(":dateAlbum", $date);
      foreach($conn->query($requete_trie) as $trie){
          if($trie['titre'] == $album) {
            $repetition = true;
            break;
          }
        }
      if($repetition == false){
        $stmt->execute();
        echo "L'album a ete enregistre avec succes.";
      }
      else
        echo "L'album est deja enregistre.";

      }
      }  
    
    
?>