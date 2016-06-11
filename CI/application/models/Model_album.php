<?php
  class Model_album extends CI_Model {     
      public function inserer($date, $genre, $album, $nom, $prenom){
        session_start();
        $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");  
        $repetition=false;
        $stmt = $conn->prepare("INSERT INTO Album (numArtiste,titre,dateAlbum,genre) VALUES (:numArtiste,:titre,:dateAlbum,:genre)");
        $requete_trie = "SELECT * from Artiste, Album where idArtiste=numArtiste"; /*Requete pour verifier que lalbum nest pas deja dans la base de donnee*/

        $query = $conn->query("SELECT idArtiste from Artiste where nom='".$nom."' and prenom ='".$prenom."'"); /*Requete pour inserer un album*/  
        $resultat = $query->fetch(PDO::FETCH_ASSOC);
        $numArt = $resultat['idArtiste'];


        $stmt->bindParam(":numArtiste", $numArt);
        $stmt->bindParam(":titre", $album);
        $stmt->bindParam(":dateAlbum", $date);
        $stmt->bindParam(":genre", $genre); 


        foreach($conn->query($requete_trie) as $trie){
            if($trie['titre'] == $album && $numArt ==$trie['numArtiste']) {
              $repetition = true;
              break;
            }
          }
				
				$requete_trie = "SELECT * from Album where titre='".$album."' limit 1";
				 foreach($conn->query($requete_trie) as $trie){
            if($trie['titre'] == $album && $numArt !=$trie['numArtiste']) {
							$stmt = $conn->prepare("INSERT INTO Album (numArtiste,titre,dateAlbum,genre,note,idAlbum) VALUES (:numArtiste,:titre,:dateAlbum,:genre,:note,:idAlbum)");
							$stmt->bindParam(":numArtiste", $numArt);
							$stmt->bindParam(":titre", $album);
							$stmt->bindParam(":dateAlbum", $trie['dateAlbum']);
							$stmt->bindParam(":genre", $trie['genre']);
							$stmt->bindParam(":note", $trie['note']);
							$stmt->bindParam(":idAlbum", $trie['idAlbum']);
							$repetition = false;
              break;
            }
          }
					
				
        if($repetition == false){
          $stmt->execute();
          $_SESSION['message_ajout_album'] = "L'album a ete enregistre avec succes.";
        }
        else
          $_SESSION['message_ajout_album'] = "L'album est deja enregistre.";

        }
                                      
        public function getInfo($id){
          $query = "SELECT * from Album, Artiste where titre in (
          SELECT titre from Album where idAlbum =".$id."
          ) and idArtiste=numArtiste";
          return $query;
        }
    
        public function insererNote($note, $titre, $email){
          $repetition = false;
          
          $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
          
          $query = $conn->query("SELECT * from Utilisateur where email ='".$email."'"); 
          $resultat = $query->fetch(PDO::FETCH_ASSOC);
          $numUtilisateur = $resultat['idUtilisateur'];
          
          $query = $conn->query("SELECT * from Album where titre ='".$titre."'");   
          $resultat = $query->fetch(PDO::FETCH_ASSOC);
          $numAlbum = $resultat['idAlbum'];
          
          $stmt = $conn->prepare("INSERT INTO Note(dateNote, note, numUtilisateur, numAlbum) VALUES (:dateNote,:note,:numUtilisateur,:numAlbum)");
          $date = strftime('%Y-%m-%d');
          $stmt->bindParam(":dateNote", $date);
          $stmt->bindParam(":note", $note);
          $stmt->bindParam(":numUtilisateur", $numUtilisateur);
          $stmt->bindParam(":numAlbum", $numAlbum);
          
          /* Verification que l'album n'est pas deja note*/
          $query = $conn->query("SELECT * from Utilisateur,Note,Album where 
					idUtilisateur=numUtilisateur 
					and idAlbum=numAlbum 
					and email='".$_SESSION['email']."'"); 
          
          foreach($query as $verif){
              if($titre == $verif['titre']){
                $repetition = true;/*L'utilisateur a deja note cette album, on met la note a jour*/
                break;
              }
          }
          
          if($repetition ==true){
            $stmt = $conn->prepare("UPDATE Note SET note =".$note.",dateNote ='".strftime('%Y-%m-%d')."' WHERE numUtilisateur=".$numUtilisateur."");
          }
					
            $stmt->execute();
        }
      }

    
?>