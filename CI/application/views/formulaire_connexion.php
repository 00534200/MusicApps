<html>
  <head>
   <link rel="stylesheet" href="assets/css/bootstrap.css" />

  </head>
  <body>
    
      <header>
    <ul id="nav"><!--
		--><li><a style="height:40px" href="#">Accueil</a></li><!--
		--><li><a style="height:40px" href="#">Album</a></li><!--
		--><li><a style="height:40px" href="artistes">Artiste</a></li><!--
		--><li><a  style="height:40px" href="connecter">Mon Compte</a></li>
			<li><a  style="height:40px" href="rechercher">Rechercher</a></li>	
</ul>
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