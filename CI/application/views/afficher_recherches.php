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
								<option value="rechercher" selected>Utilisateur</option> 
								<option value="rechercher/album">Album</option>
							</select>
						</td>
				 </tr>
			</form>
		</table>
    <table class="table table-striped   table-condensed">
           <?php	
						$conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
            if(isset($_GET['rechercher']) && $_GET['rechercher'] != ""){
								extract($_GET);/*On extrait les informations en entre dans $nom, $prenom, et $album*/
								echo "<tr>";
									echo "<td>recherches correspondant à '".$rechercher."'</td>";
								echo "</tr>";
                if($_GET['select'] == "rechercher") {
									$search = "SELECT * from Utilisateur where  (
											nom like '%".$rechercher."%' or 
											prenom  like '%".$rechercher."%' or
											email like '%".$rechercher."%'
										) and inscrit = 1";
                  if($search){
										echo "<tr>";
										echo "<th>Nom</th>";
										echo "<th>Prenom</th>";
										echo "<th>E-mail</th>";
										echo "</tr>";
                    foreach($conn->query($search) as $var ){
                      echo "<tr>";
                      echo "<td>".$var['nom']."</td>";
                      echo "<td>".$var['prenom']."</td>";
                      echo "<td>".$var['email']."</td>";
                      echo "<td><a href='notes/liste/".$var['idUtilisateur']."'>Notes</a></td>";
                      echo "<td><a href='commentaire/liste/".$var['idUtilisateur']."'>Commentaires</a></td>";
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