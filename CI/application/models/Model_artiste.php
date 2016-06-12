<?php
session_start();
class Model_artiste extends CI_Model {
    private $nom;
    private $prenom;
    private $date;
  
  public function inserer($nom,$prenom){
    $this->nom=$nom;
    $this->prenom=$prenom;
    $repetition=false;
    $conn = new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
    $stmt = $conn->prepare("INSERT INTO Artiste (nom,prenom) VALUES (:nom,:prenom)"); /*Requete pour inserer un artiste*/
    $requete_trie = "SELECT nom, prenom from Artiste";/*Requete pour verifier que lartiste nest pas deja dans la base de donnee*/
    if(!$stmt) die ("pb");
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom); 

    foreach($conn->query($requete_trie) as $trie){
          if(($trie['nom'] == $nom && $trie['prenom'] == $prenom) || ($trie['nom'] == $prenom && $trie['prenom'] == $nom)) {
            $repetition = true;
            break;
          }
        }
    if($repetition == false) {
      $stmt->execute();
      $_SESSION['message_ajout_artiste'] =  "L'artiste a ete enregistre avec succes.";
    }
    else
      $_SESSION['message_ajout_artiste'] =  "L'artiste est deja enregistre.";

  }

  
  
}
?>