<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Model{
    private $email;
    private $nom;
    private $prenom;
    private $mdp;
    
    public function inserer($email, $nom, $prenom, $mdp){
      $this->nom=$nom;
      $this->prenom=$prenom;
      $this->mdp=$mdp;
      $this->email=$email;
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $repetition=false;
      $stmt2 = $conn->prepare("INSERT INTO Utilisateur (email,nom,prenom,mdp) VALUES (:email,:nom,:prenom,:mdp)");
      $requete_trie = "SELECT * from Utilisateur where email='".$email."'";
      $stmt2->bindParam(":nom", $nom);
      $stmt2->bindParam(":prenom", $prenom);
      $stmt2->bindParam(":email", $email);
      $stmt2->bindParam(":mdp", $mdp);
      foreach($conn->query($requete_trie) as $trie){
          if($trie['email'] == $email) {
            $repetition = true;
            break;
          }
        }
      if($repetition == false){
        $stmt2->execute();
        echo "Vous avez ete enregistre avec succes.";
      }
      else
        echo "L'utilisateur est deja enregistre.";

      }
    
    
    public function seConnecter($email, $mdp){
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $utilisateur=false;
      $query = "SELECT * from Utilisateur where email='".$email."' and mdp='".$mdp."'";
      $idUtilisateur = "SELECT idUtilisateur from Utilisateur where email='".$email."' and mdp='".$mdp."'";;
      foreach($conn->query($query) as $trie){
          if($trie['email'] == $email && $trie['mdp'] == $mdp) {
            $utilisateur = true;
            break;
          }
        }
      if($utilisateur){
        echo "Bienvenue ".$trie['nom']." ".$trie['prenom'].".";
      }
      else
        echo "Authentification invalide.";
      
    }
  
    
    public function getListeNote($id){
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $query = "SELECT * from Album, Utilisateur, Note where idAlbum=numAlbum and idUtilisateur=numUtilisateur and idUtilisateur='".$id."' ";
      foreach($conn->query($query) as $trie){
          echo "Note :".$trie['note']." Album :".$trie['titre']."<br>";
        }
    }
    
    public function getListeCommentaires($email){
      
    }
    
      
    }
?>