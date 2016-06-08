<html>
  <head>
   <link rel="stylesheet" href="assets/css/bootstrap.css" />

  </head>
  <body>
      <header>
				<thead><a style="height:40px" href="#">Accueil</a></thead>
				<thead><a style="height:40px" href="#">Album</a></thead>
				<thead><a style="height:40px" href="artistes">Artiste</a></thead>
				<thead><a  style="height:40px" href="connecter">Mon Compte</a></thead>
				<thead><a  style="height:40px" href="rechercher">Rechercher</a></thead>
    </header>
    
    <form method="post" action="Connecter/traitement">
      email : <input type="text" name="email">
      <br>
      mot de passe : <input type="password" name="mdp">
      <br>
       <input type="submit" name="connexion" value="connexion">
    </form>
  </body>
</html>