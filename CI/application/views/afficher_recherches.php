
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
			 <form action="" method="get"> 
					<legend><b>Recherche</b></legend>
					<input id="el" type="text" name="rechercher"/>
					<input type="submit" id="Rechercher" value="Rechercher"><br>
				 	<tr>
						<td>type:</td>
						<td>
							<select name="select">
								<option value="utilisateur">Utilisateur</option> 
								<option value="album">Album</option>
							</select>
						</td>	
				 	</tr>	
			</form>
		</table>
    <table border=1>
           <?php
						$conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
            if(isset($_GET['rechercher'])){
                extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
                if($_GET['select'] == "album") {
                  $search="SELECT * from Artiste, Album where idArtiste = numArtiste and (
										dateAlbum like '%".$rechercher."%' or 
										nom like '%".$rechercher."%' or
										prenom  like '%".$rechercher."%' or
										titre like '%".$rechercher."%' or
										genre like '%".$rechercher."%' or
										note like '%".$rechercher."%'
									)";
                  if($search){
                    foreach($conn->query($search) as $var ){
                      echo "<tr>";
                      echo "<td>".$var['titre']."</td>";
                      echo "<td>".$var['dateAlbum']."</td>";
											echo "<td>".$var['note']."</td>";
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
                      echo "<td><a href='notes/liste/".$var['idUtilisateur']."'>Notes</a></td>";
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