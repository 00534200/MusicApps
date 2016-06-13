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
    <h>Bienvenue <?php echo $_SESSION['nom']." ".$_SESSION['prenom']; ?> !</h>
  </body>
</html>