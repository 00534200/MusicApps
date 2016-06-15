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
				 	if(isset($_SESSION['ADMIN'])) {
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
			<th>Palmares</th>
					<?php
						$conn = new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
						$search = "SELECT * from Album group by(titre)";
						$top = 3;
						$tmp = 0;
						$top_note = array();
						$titre_album = "";
							for($i = 1; $i <=$top; $i++){		
							 foreach($conn->query($search) as $var ){
									if($tmp < $var['note'] && in_array($var['titre'],$top_note)==false){
										$tmp = $var['note'];
										$titre_album = $var['titre'];
									}
								}
								$tmp = 0;
								$top_note[$i]=$titre_album;
							}
							for($i = 1; $i <=$top; $i++){
									echo "<tr>";
									echo "<td>".$i." - ".$top_note[$i]."</td>";
									echo "</tr>";
							}	
					?>
		</table>
  </body>
</html>