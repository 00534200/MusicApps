<html lang=fr>
  <head>
   <link rel="stylesheet" href="assets/css/bootstrap.css" />
  </head>
  <body>
      <header>
        <thead>
          <a style="height:40px" href= <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/CI/#'; ?> >
            Accueil
          </a>
        </thead>
				<thead>
          <a style="height:40px" href= <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/CI/artistes'; ?> >
            Ajouter
          </a>
        </thead>
        <thead>
          <a style="height:40px" href = <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/CI/'. $_SESSION['etat_conn']; ?>>
           <?php echo $_SESSION['etat_conn'];?>
          </a>
        </thead>
        <thead>
          <a style="height:40px" href= <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/CI/rechercher'; ?> >
            Rechercher
          </a>
        </thead>
    </header>
    <table>
      <?php
        	$conn = new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
					
          foreach( $conn->query($value) as $afficher){
						echo "<tr>";
						echo "<td>Titre :</td>";
						echo "<td>".$afficher['titre']."</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Note global :</td>";
						echo "<td>".$afficher['note']."</td>";
						echo "</tr>";
						$query = $conn->query("SELECT distinct Note.note,dateNote from Utilisateur,Note,Album where 
						idUtilisateur=numUtilisateur
						and numAlbum=".$afficher['idAlbum']." 
						and email='".$_SESSION['email']."'"); 
						$resultat = $query->fetch(PDO::FETCH_ASSOC);
						$note_perso = $resultat['note'];
						$date_note_perso = $resultat['dateNote'];
						echo "<tr>";
						echo "<td>Note personnelle :</td>";
						echo "<td>".$note_perso." le ".$date_note_perso."</td>";
						echo "</tr>";	
						echo "<tr>";
						echo "<td>Date de sortie :</td>";
						echo "<td>".$afficher['dateAlbum']."</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Genre :</td>";
						echo "<td>".$afficher['genre']."</td>";
						echo "</tr>";
						echo "</table>";
						echo "<table>";  
						echo "<tr>";
						echo "<td>Artistes : ";
						break;  
          } 
          foreach($conn->query($value) as $artiste){
            echo $artiste['nom']." ".$artiste['prenom']." - ";
          }
          echo "</td>";
          echo "</tr>";
          echo "</table>";
					echo "<form action='notes/ajouter/".$afficher['titre']."' method='get'>"; 
				 ?>
					<legend><b>Note et Commentaire</b></legend>
				 	<tr>
						<td>Ta note :</td>
						<td>
							<input min="0" max="10" type="number" name="note"/>/10
						</td>	
				 	</tr>
					<tr>
						<td>
							<input type="submit" name="Notez" value="Notez!"/>
						</td>	
				 	</tr>	
			</form>
		
		
		     <form method="GET" action="com.php">
           <p>
       <label for="ameliorer">
      Que pensez vous de cette music?
       </label>
       <br />
       
       <textarea  id="com1" rows="10" cols="50">
       </textarea>       
          </p>
        
         <input type="submit" id="Ajouter" value="OK">
           </form>
		
		
		
		
		
  </body>
</html>