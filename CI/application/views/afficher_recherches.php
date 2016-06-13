<?php
	if(!isset($_SESSION['etat_conn']))
		session_start();
?>
<html>
  <head>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
  </head>
  <body>
    <header>
				<thead><a style="height:40px" href="accueil">Accueil</a></thead>
				<thead><a style="height:40px" href="artistes">Ajouter</a></thead>
        <thead>
          <a style="height:40px" href = <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/CI/'. $_SESSION['etat_conn']; ?>>
           <?php echo $_SESSION['etat_conn'];?>
          </a>
        </thead>
				<thead><a  style="height:40px" href="rechercher">Rechercher</a></thead>
				 <?php
				 	if($_SESSION['ADMIN'] == true) {
						echo "<thead>";
							echo "<a href='demandes' style='height:40px'>Demandes</a>";
						echo "</thead>";
					}
				 ?>
					<thead>
        		<?php echo $_SESSION['type']." : ".$_SESSION['nom']." ";
							if(isset($_SESSION['prenom']))
								echo $_SESSION['prenom']; 
						?>
					</thead>
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
    <table class="table table-striped   table-condensed">
           <?php	
						$conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
            if(isset($_GET['rechercher'])){
                extract($_GET); /*On extrait les informations en entre dans $nom, $prenom, et $album*/
                if($_GET['select'] == "album") {
                  $search="SELECT * from Album where (
										dateAlbum like '%".$rechercher."%' or
										titre like '%".$rechercher."%' or
										genre like '%".$rechercher."%' or
										note like '%".$rechercher."%'
									) group by (titre)";
                  if($search){
										$recurrence;
										echo "<tr>";
										echo "<th>Titre</th>";
										echo "<th>Date</th>";
										echo "<th>Note</th>";
										echo "<th>Genre</th>";
										echo "</tr>";
                    foreach($conn->query($search) as $var ){
                      echo "<tr>";
                      echo "<td><a href='album/info/".$var['idAlbum']."'>".$var['titre']."</a></td>";
											echo "<td>".$var['dateAlbum']."</td>";
											echo "<td>".$var['note']."</td>";
											echo "<td>".$var['genre']."</td>";
                      echo "</tr>";
											
                    }
                  }
                }
                if($_GET['select'] == "utilisateur") {
									$search = "SELECT * from Utilisateur where  (
											nom like '%".$rechercher."%' or 
											prenom  like '%".$rechercher."%' or
											email like '%".$rechercher."%'
										) and inscrit = 1";
                  if($search){
										echo "<tr>";
										echo "<th>Nom</th>";
										echo "<th>Prenom</th>";
										echo "</tr>";
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