<?php
  class Model_album extends CI_Model {
      private $album;
    
      public function inserer($album, $nom, $prenom){
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");  
        
      $this->album = $album; 
      $repetition=false;
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $stmt = $conn->prepare("INSERT INTO Album (numArtiste,titre,dateAlbum,genre,note) VALUES (:numArtiste,:titre,:dateAlbum,:genre,:note)");
      $requete_trie = "SELECT * from Artiste, Album where idArtiste=numArtiste"; /*Requete pour verifier que lalbum nest pas deja dans la base de donnee*/
              
      $query = $conn->query("SELECT idArtiste from Artiste where nom='".$nom."' and prenom ='".$prenom."'"); /*Requete pour inserer un album*/  
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      $numArt = $resultat['idArtiste'];
        
      $query1 = $conn->query("SELECT * from Album where titre='".$album."' and (dateAlbum!='0000-00-00' or genre != null or note!=null) limit 1 "); 
      $resultat1 = $query1->fetch(PDO::FETCH_ASSOC);
      $dateAlbum = $resultat1['dateAlbum'];
      $genre = $resultat1['genre'];
      $note = $resultat1['note'];  
        
      $stmt->bindParam(":numArtiste", $numArt);
      $stmt->bindParam(":titre", $album);
      $stmt->bindParam(":dateAlbum", $dateAlbum);
      $stmt->bindParam(":genre", $genre);
      $stmt->bindParam(":note", $note);  
        
        
      foreach($conn->query($requete_trie) as $trie){
          if($trie['titre'] == $album && $numArt ==$trie['numArtiste']) {
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