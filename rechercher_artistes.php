
<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
    <ul id="nav"><!--
	--><li><a style="height:40px" href="#">Accueil</a></li><!--
	--><li><a style="height:40px" href="#">Album</a></li><!--
	--><li><a style="height:40px" href="#">Artiste</a></li><!--
	--><li><a  style="height:40px" href="#">Mon Compte</a></li>
</ul>
    </header>
    
     <form action="rechercher_artistes.php" method="get"> 
      <fieldset>
        <legend><b>Recherche</b></legend>
        <input id="el" type="text" name="rechercher"/>
        <input type="submit" id="Rechercher" value="Rechercher"><br>
        <label for="el">type</label>:
        <select name="select">
          <option value="utilisateur">Utilisateur</option> 
          <option value="album">Album</option>
        </select>
        </fieldset>
    </fieldset>
  </form>
    <table border=1>
           <?php
            include ('index.php');
            $init = new Connexion("dwarves.iut-fbleau.fr","reilhac","reilhac","toto");
            $conn = $init->seConnecter();
            if(isset($_GET['rechercher'])){
                extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
                if($_GET['select'] == "album") {
                  $search = "SELECT * from Artiste, Album where idArtiste = numArtiste and (
                    dateAlbum like '%".$rechercher."%' or 
                    nom like '%".$rechercher."%' or
                    prenom  like '%".$rechercher."%' or
                    titre like '%".$rechercher."%' or
                    genre like '%".$rechercher."%'
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
                  $search = "SELECT * from Utilisateur where  (
                    nom like '%".$rechercher."%' or 
                    prenom  like '%".$rechercher."%' or
                    email like '%".$rechercher."%'
                  )";
                  if($search){
                    foreach($conn->query($search) as $var ){
                      echo "<tr>";
                      echo "<td>".$var['nom']."</td>";
                      echo "<td>".$var['prenom']."</td>";
                      echo "<td>".$var['email']."</td>";
                      echo "<td><a href='liste_notes.php?email=".$var['email']." >Notes</a></td>";
                      echo "<td><a href='liste_commentaires.php'>Commentaires</a></td>";
                      echo "</tr>";
                    }
                  }
                  
                }
            }
            
            $conn = null;
          ?>
    </table>
  </body>
</html>