<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
     <form action="ajouter_artistes.php" method="get"> 
      <fieldset>
        <legend><b>Formulaire</b></legend>
        <label for="el1">Nom</label>:
        <input id="el1" type="text" name="nom" /><br>
        <label for="el2"> Prenom </ label>:
        <input id="el2" type="text" name="prenom" /><br>
        </fieldset>
      <input type="submit" name="Ajouter" value="OK">
    </fieldset>
  </form>
    <table border=1>
      <tr>
        <th>idArtiste</th>
        <th>Nom</th>
        <th>Prenom</th>  
        </tr>
           <?php
            $servername = "dwarves.iut-fbleau.fr";
            $username = "reilhac";
            $password = "toto";
            $dbname = "reilhac";
      
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                
            if(isset($_GET['nom']) && isset($_GET['prenom'])){
                extract($_GET);
                $stmt = $conn->prepare("INSERT INTO Artiste (nom,prenom) VALUES (:nom,:prenom)");
                if(!$stmt) die ("pb");
                $stmt->bindParam(":nom", $nom);
                $stmt->bindParam(":prenom", $prenom);
                // use exec() because no results are returned
                $stmt->execute();
                echo "New record created successfully";
                
            }
      
            $resultat="SELECT * FROM Artiste"; 
      
            if($resultat){
              foreach($conn->query($resultat) as $artiste ){
              echo "<tr>";
              echo "<td>".$artiste['idArtiste']."</td>";
              echo "<td>".$artiste['nom']."</td>";
              echo "<td>".$artiste['prenom']."</td>";  
              echo "</tr>";

            }
            }
                else die ("<p>Erreur dans l'execution de la requete.</p>");
               $conn = null;
    ?>
    </table>
  </body>
<html>
  