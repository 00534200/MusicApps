 <html>
  <head>
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
             
            include ('index.php');
      
            $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
            $conn = $init->seConnecter();
            if(isset($_GET['nom']) && isset($_GET['prenom']) && $_GET['prenom'] != null && $_GET['nom'] != null  ){
                extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
                $nv_artiste = new Artiste($nom,$prenom,$conn);
                $nv_artiste->insererArtiste($nv_artiste->getNom(), $nv_artiste->getPrenom());
                 if(isset($_GET['album']) && $_GET['album'] != null)
                   $nv_artiste->insererAlbum($album);
                }
            else 
              echo "Entrer un artiste ou un album.";
            
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
            $conn = null;
            
          ?>
    </table>
  </body>
</html>