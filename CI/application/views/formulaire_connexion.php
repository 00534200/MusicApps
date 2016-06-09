<html>
  <head>
   <link rel="stylesheet" href="assets/css/bootstrap.css" />

  </head>
  <body>
      <header>
				<thead><a style="height:40px" href="#">Accueil</a></thead>
				<thead><a style="height:40px" href="artistes">Ajouter</a></thead>
				<thead><a  style="height:40px" href="connecter">MonCompte</a></thead>
				<thead><a  style="height:40px" href="rechercher">Rechercher</a></thead>
    </header>
    <table>
			<form method="post" action="Connecter/traitement">
				<tr>
					<td>email :</td> 
					<td><input type="text" name="email"></td>
				</tr>	
				<tr>
					<td>mot de passe :</td>
					<td><input type="password" name="mdp"></td>
				</tr>
				<tr>
					<td><input type="submit" name="connexion" value="connexion"></td>
					<td><a href="inscription">s'inscrire</a></td>	
				</tr>	
			</form>
		</table>
  </body>
</html>