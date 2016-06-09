<?php
	session_start();
	header('Content-type: text/html; charset=UTF-8');
?>
<html>
  <head>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
  </head>
    <body>
       <header>
				<thead><a style="height:40px" href="#">Accueil</a></thead>
				<thead><a style="height:40px" href="artistes">Ajouter</a></thead>
        <thead>
          <a style="height:40px" href = <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/CI/'. $_SESSION['etat_conn']; ?>>
           <?php echo $_SESSION['etat_conn'];?>
          </a>
        </thead>
				<thead><a  style="height:40px" href="rechercher">Rechercher</a></thead>
    	</header>
			<table>
				 <form action="artistes/traitement" method="get"> 
						<legend><b>Ajout d'artistes et d'album</b></legend>
						<tr>
							<td>Nom :</td>
							<td><input style="height:30px" type="text" name="nom" /></td>
						</tr>	
						<tr>
							<td>Prenom :</td>
							<td><input style="height:30px" type="text" name="prenom" /></td>
						</tr>	
						<tr>
							<td>Titre :</td>
							<td><input style="height:30px" type="text" name="album" /></td>
						</tr>
						<tr>
							<td>Date :</td>
							<td><input style="height:30px" type="text" name="date"  placeholder="AAAA" /></td>
						</tr>
						<tr>
							<td>Genre :</td>
							<td><input style="height:30px" type="text" name="genre"  /></td>
						</tr>
							<td><input style="height:30px" type="submit" id="Ajouter" value="OK"></td>
						<tr>
				 </form>
			</table>
			<p>Indication : pour ajouter un album mettre son artiste</p>
			<div>
				<div id="afficher_artistes">
						<table class="table table-striped   table-condensed">
							<tr>
								<th>Titre</th>
								<th>Date</th>
								<th>Genre</th>
								<th>Note</th>
							</tr>
								<?php
									$conn = new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
									if(isset($_SESSION['message_ajout_artiste'])){
										echo "<p>".$_SESSION['message_ajout_artiste'].".</p>";
										unset($_SESSION['message_ajout_artiste']);
									}
									if(isset($_SESSION['message_ajout_album'])){
										echo "<p>".$_SESSION['message_ajout_album'].".</p>";
										unset($_SESSION['message_ajout_album']);
									}
									$resultat="SELECT * FROM Album group by (titre)";
									if($resultat){
											foreach($conn->query($resultat) as $afficher ){
												echo "<tr>";
												echo "<td>".$afficher['titre']."</td>";
												echo "<td>".$afficher['dateAlbum']."</td>";
												echo "<td>".$afficher['genre']."</td>";
												echo "<td>".$afficher['note']."</td>";	
												echo "</tr>";
											}
										}

								?>
						</table>
				</div>
				<div id="afficher_album">
					<table class="table table-striped   table-condensed">
						<tr>
							<th>Nom</th>
							<th>Prenom</th>
						</tr>
						<?php
								$resultat="SELECT * FROM Artiste";
								if($resultat){
										foreach($conn->query($resultat) as $afficher ){
											echo "<tr>";
											echo "<td>".$afficher['nom']."</td>";
											echo "<td>".$afficher['prenom']."</td>";
											echo "</tr>";
										}
									}

							?>
					</table>	
				</div>
			</div>		
  </body>
</html>