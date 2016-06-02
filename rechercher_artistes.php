<html>
  <head>
  </head>
  <body>
     <form action="rechercher_artistes.php" method="get"> 
      <fieldset>
        <legend><b>Recherche</b></legend>
        <label for="el">Rechercher</label>:
        <input id="el" type="text" name="rechercher" /><br>
        <label for="el">type</label>:
        <select name="select">
          <option value="utilisateur">Utilisateur</option> 
          <option value="album">Album</option>
        </select>
        </fieldset>
      <input type="submit" name="Ajouter" value="OK">
    </fieldset>
  </form>
    <table border=1>
     <!-- <tr>
        <th>Album</th>
        <th>Nom</th>
        <th>Prenom</th>  
      </tr>-->
           <?php
            include ('index.php');
            $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
            $conn = $init->seConnecter();
            if(isset($_GET['rechercher']) && $_GET['rechercher'] != null ){
                extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
                if($_GET['select'] == "album") {
                  echo "album";
                  $search = "SELECT * from Artiste, Album where idArtiste = numArtiste and (
                    dateAlbum like '%".$rechercher."%' or 
                    nom like '%".$rechercher."%' or
                    prenom  like '%".$rechercher."%' or
                    titre like '%".$rechercher."%'
                  )";
                  if($search){
                    foreach($conn->query($search) as $var ){
                      echo "<tr>";
                      echo "<td>".$var['titre']."</td>";
                      echo "<td>".$var['dateAlbum']."</td>";
                      echo "<td>".$var['nom']."</td>";
                      echo "<td>".$var['prenom']."</td>";
                      echo "</tr>";
                    }
                  }
                  
                }
                if($_GET['select'] == "utilisateur") {
                  echo "utilisateur";    
                }
            }
            else 
              echo "Entrer un artiste ou un album.";
            
            $conn = null;
          ?>
    </table>
  </body>
</html>