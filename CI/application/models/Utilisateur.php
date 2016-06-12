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
        echo "Votre demande a ete envoye.";
      }
      else
        echo "L'utilisateur est deja enregistre.";

      }
    
    
    public function seConnecter($email, $mdp){
      session_start();
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $utilisateur=false;
      $admin = false;
      $query = "SELECT * from Utilisateur where email='".$email."' and mdp='".$mdp."'";
      $idUtilisateur = "SELECT idUtilisateur from Utilisateur where email='".$email."' and mdp='".$mdp."'";
      foreach($conn->query($query) as $trie){
          if($trie['email'] == $email && $trie['mdp'] == $mdp && $trie['inscrit']==1) {
            $utilisateur = true;
            break;
          }
        }
      $query = "SELECT * from Admin where nomAdmin='".$email."' and mdpAdmin='".$mdp."'";
      foreach($conn->query($query) as $trie1){
          if($trie1['nomAdmin'] == $email && $trie1['mdpAdmin'] == $mdp) {
            $utilisateur = true;
            $admin = true;
            break;
          }
        }
      if($utilisateur){
        $_SESSION['type'] ="Utilisateur";
        $_SESSION['email'] =$email;
        $_SESSION['nom'] =$trie['nom'];
        $_SESSION['prenom'] =$trie['prenom'];
        $_SESSION['etat_conn'] ="deconnexion";
        $_SESSION['ADMIN'] = $admin;
      }
      
      if($admin ==true){
        $_SESSION['type'] ="Administrateur";
        $_SESSION['nom'] =$trie1['nomAdmin'];
        $_SESSION['etat_conn'] ="deconnexion";
        $_SESSION['ADMIN'] = $admin;
      }
      else
        echo "Authentification invalide";
      
    }
  
    public function validez($id){
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $query = $conn->prepare("UPDATE Utilisateur set inscrit=1 where idUtilisateur =".$id."");
      $query->execute();
    }
  
    
    public function getListeNote($id){
      $conn =  new PDO("mysql:host=dwarves.iut-fbleau.fr;dbname=reilhac", "reilhac", "toto");
      $query = "SELECT * from Album, Utilisateur, Note where idAlbum=numAlbum and idUtilisateur=numUtilisateur and idUtilisateur='".$id."' group by (titre)";
      foreach($conn->query($query) as $trie){
          echo "Note :".$trie['note']." Album :".$trie['titre']."<br>";
        }
    }
    
    public function getListeCommentaires($email){
      
    }
    
      
    }
?>