<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
     <form action="ajouter_artistes.php" method="get"> 
      <fieldset>
        <legend><b>Ajout d'artistes</b></legend>
        <label for="el1">Nom</label>:
        <input id="el1" type="text" name="nom" /><br>
        <label for="el2"> Prenom </ label>:
        <input id="el2" type="text" name="prenom" /><br>
        <label for="el2"> Album </ label>:
        <input id="el2" type="text" name="album" /><br>
        </fieldset>
      <input type="submit" name="Ajouter" value="OK">
    </fieldset>
  </form>
    <table border=1>
      <tr>
        <th>Album</th>
        <th>Nom</th>
        <th>Prenom</th>  
        </tr>
           <?php
            include 'connexion.php';
            $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
            $conn = $init->seConnecter();
            $repetition1=false;
            $repetition2=false;
                
            if(isset($_GET['nom']) && isset($_GET['prenom']) && $_GET['prenom'] != null && $_GET['nom'] != null  ){
                extract($_GET);/*On extrait les informations en entre dans $nom, $prenom, et $album*/
                $stmt = $conn->prepare("INSERT INTO Artiste (nom,prenom) VALUES (:nom,:prenom)"); /*Requete pour inserer un artiste*/
                $requete_trie = "SELECT nom, prenom from Artiste where nom='".$nom."' and prenom='".$prenom."'";/*Requete pour verifier que lartiste nest pas deja dans la base de donnee*/
                if(!$stmt) die ("pb");
                $stmt->bindParam(":nom", $nom);
                $stmt->bindParam(":prenom", $prenom); 
                
                foreach($conn->query($requete_trie) as $trie){
                      if($trie['nom'] == $nom && $trie['prenom'] == $prenom) {
                        $repetition2 = true;
                        break;
                      }
                    }
                if($repetition2 == false) {
                  $stmt->execute();
                  echo "L'artiste a été enregistré avec succés.";
                }
                else
                  echo "L'artiste est déjà enregistré.<br>";
              
                if(isset($_GET['album']) && $_GET['album'] != null){
                  $stmt2 = $conn->prepare("INSERT INTO Album (numArtiste,titre) VALUES (:numArtiste,:titre)");
                  $query = $conn->query("SELECT idArtiste from Artiste where nom='".$_GET['nom']."' and prenom ='".$_GET['prenom']."'"); /*Requete pour inserer un album*/
                  $requete_trie2 = "SELECT * from Artiste, Album where idArtiste=numArtiste"; /*Requete pour verifier que lalbum nest pas deja dans la base de donnee*/
                  $resultat = $query->fetch(PDO::FETCH_ASSOC);
                  $numArt = $resultat['idArtiste'];
                  $stmt2->bindParam(":numArtiste", $numArt);
                  $stmt2->bindParam(":titre", $album);
                  foreach($conn->query($requete_trie2) as $trie){
                      if($trie['titre'] == $album) {
                        $repetition1 = true;
                        break;
                      }
                    }
                  if($repetition1 == false){
                    $stmt2->execute();
                    echo "L'album a été enregistré avec succés.";
                  }
                  else
                    echo "L'album est déjà enregistré.";
                }
                
            }
      
            $resultat="SELECT * FROM Artiste join Album where numArtiste=idArtiste"; 
      
            if($resultat){
              foreach($conn->query($resultat) as $artiste ){
              echo "<tr>";
              echo "<td>".$artiste['titre']."</td>";
              echo "<td>".$artiste['nom']."</td>";
              echo "<td>".$artiste['prenom']."</td>";  
              echo "</tr>";

            }
            }
                else die ("<p>Erreur dans l'execution de la requete.</p>");
               $conn = null;
    ?>
    </table>
  </body>
<html>
  