<html>
  <head>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
  </head>
    <body>
       <header>
				<thead><a style="height:40px" href="#">Accueil</a></thead>
				<thead><a style="height:40px" href="#">Album</a></thead>
				<thead><a style="height:40px" href="artistes">Artiste</a></thead>
				<thead><a  style="height:40px" href="connecter">Mon Compte</a></thead>
				<thead><a  style="height:40px" href="rechercher">Rechercher</a></thead>
    	</header>
			<table>
     <form action="artistes/traitement" method="get"> 
        <legend><b>Ajout d'artistes et d'album</b></legend>
				<tr>
					<td>Nom :</td>
					<td><input type="text" name="nom" /></td>
				</tr>	
				<tr>
					<td>Prenom :</td>
					<td><input type="text" name="prenom" /></td>
				</tr>	
				<tr>
					<td>Titre Album:</td>
					<td><input type="text" name="album" /></td>
				</tr>
				<tr>
					<td>Date Album:</td>
					<td><input type="date" name="date"  placeholder="AAAA-MM-JJ" /></td>
				</tr>
			 		<td><input type="submit" id="Ajouter" value="OK"></td>
			 	<tr>
      	
    </fieldset>
  </form>
			</table>
  
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
						echo "<td>".$artiste['note']."</td>";	
						echo "</tr>";
						}
					}
				?>
    </table>
  </body>
</html>