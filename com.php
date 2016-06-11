<?php
if(isset($_GET['com1']))
  $com = $_GET['com1'];

$db = mysql_connect('dwarves.iut-fbleau.fr', 'reilhac', 'toto')  
  or die('Erreur de connexion '.mysql_error());

    mysql_select_db('reilhac',$db) 
      or die('Erreur de selection '.mysql_error()); 

  $sql = "INSERT INTO Commentaire( dateCom, contenue) 
  VALUES('$date','$com')"; 

    mysql_query($sql) 
      or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 

      mysql_close();
?>