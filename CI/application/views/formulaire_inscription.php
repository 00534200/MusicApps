<html>
  <head>
    <link rel="stylesheet" href="style.css" />
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
    
    <form method="post" action="inscription/traitement">
      nom : <input type="text" name="nom">
      <br>
      prenom : <input type="text" name="prenom">
      <br>
      email : <input type="text" name="email">
      <br>
      Tapez votre mot de passe : <input type="password" name="mdp">
      <br>
      Confirmez votre mot de passe : <input type="password" name="mdp1">
      <br>
      <input type="submit" name="Submit" value="Envoyer">
    </form>
  </body>
</html>