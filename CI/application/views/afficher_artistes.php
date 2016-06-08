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
	--><li><a  style="height:40px" href="connecter">Connexion</a></li>
</ul>
			
    </header>
     <form action="artistes/traitement" method="get"> 
      <fieldset>
        <legend><b>Ajout d'artistes et d'album</b></legend>
        <label for="el1">Nom</label>:
        <input id="el1" type="text" name="nom" /><br>
        <label for="el2"> Prenom </ label>:
        <input id="el2" type="text" name="prenom" /><br>
        <label for="el3"> Album </ label>:
        <input id="el3" type="text" name="album" /><br>
        <label for="el3"> Date </ label>:
        <input id="el3" type="date" name="date"  placeholder="AAAA-MM-JJ"/><br>
        </fieldset>
      <input type="submit" id="Ajouter" value="OK">
    </fieldset>
  </form>
  
    <table border=1>
      <tr>
        <th>Album</th>
        <th>Nom</th>
        <th>Prenom</th> 
      </tr>
				<?php
					$resultat="SELECT * FROM Artiste,Album where idArtiste=numArtiste"; 
					if($resultat){
						$conn = new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
						foreach($conn->query($resultat) as $artiste ){
						echo "<tr>";
						echo "<td>".$artiste['nom']."</td>";
						echo "<td>".$artiste['prenom']."</td>";
						echo "<td>".$artiste['titre']."</td>";
						echo "<td>".$artiste['dateAlbum']."</td>";
						echo "</tr>";
						}
					}
				?>
    </table>
  </body>
</html>