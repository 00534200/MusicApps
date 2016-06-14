<?php
	if(!isset($_SESSION['etat_conn']))
		session_start();
	$conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
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
				 	if(isset($_SESSION['ADMIN']) && $_SESSION['ADMIN'] == true) {
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
				 	<tr>
						<td><input style="height:35px" type="text" name="rechercher" placeholder="Ex:1999, Jackson, Pop ..."/></td>
						<td><input style="height:35px" type="submit" id="Rechercher" value="Rechercher"/></td>
						<td>type:</td>
						<td>
							<select style="height:35px" name="select" onChange="location = this.options[this.selectedIndex].value;">
								<option value="rechercher" selected>Album</option>
                <option value="rechercher/user">Utilisateur</option> 
							</select>
						</td>
						<td>par</td>
							<td><input name="choix" type="radio" value="dateAlbum"> date</td>
							<td><input name="choix" type="radio" value="titre"> titre</td>
							<td><input name="choix" type="radio" value="genre"> genre</td>
							<td><input name="choix" type="radio" value="note"> note</td>
							<td><input name="choix" type="radio" value="artiste"> artiste</td>
						</tr>	
			</form>
		</table>
    <table class="table table-striped   table-condensed">
           <?php	
						$conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
            if(isset($_GET['rechercher']) && $_GET['rechercher'] != "" && isset($_GET['choix'])){
								extract($_GET);/*On extrait les informations en entre dans $nom, $prenom, et $album*/
								echo "<tr>";
									echo "<td>recherches correspondant à '".$rechercher."'</td>";
								echo "</tr>";
                if($_GET['select'] == "rechercher") {
									$search="SELECT * from Album, Artiste where idArtiste=numArtiste and (";
									$nb_choix = 0;
									$i = 0;
									$tab = array();
									foreach($_GET as $value){
										if($value!=$rechercher  && $value!=$select){
											$tab[$i]=$value;
											$i++; 
										}
									}
									for($i=0; $i <sizeof($tab); $i++){
										if($i!=0)
											$search = $search." or";
										if($tab[$i] != null && $tab[$i]!="artiste" )
											$search = $search." ".$tab[$i]." like '%".$rechercher."%'";
										else
											$search = $search."nom like '%".$rechercher."%' or prenom like '%".$rechercher."%'";
									}
									$search=$search.") group by (titre)";
                  if($search){
										echo "<tr>";
										echo "<th>Titre</th>";
										echo "<th>Date</th>";
										echo "<th>Note</th>";
										echo "<th>Genre</th>";
										echo "<th>Artiste</th>";
										echo "</tr>";
                    foreach($conn->query($search) as $var ){
                      echo "<tr>";
                      echo "<td><a href='album/info/".$var['idAlbum']."'>".$var['titre']."</a></td>";
											echo "<td>".$var['dateAlbum']."</td>";
											echo "<td>".$var['note']."</td>";
											echo "<td>".$var['genre']."</td>";
											echo "<td>".$var['prenom']." ".$var['nom']." ...</td>";
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