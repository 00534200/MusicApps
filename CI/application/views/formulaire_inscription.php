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
    <table>
				<form method="post" action="inscription/traitement">
					<tr>
						<td>nom :</td>
						<td><input type="text" name="nom"></td>
					</tr>
					<tr>
						<td>prenom :</td> 
						<td><input type="text" name="prenom"></td>
					</tr>	
					<tr>
						<td>email :</td> 
						<td><input type="text" name="email"></td>
					</tr>	
					<tr>
						<td>Tapez votre mot de passe :</td> 
						<td><input type="password" name="mdp"></td>
					</tr>
					<tr>
						<td>Confirmez votre mot de passe :</td> 
						<td><input type="password" name="mdp1"></td>
					</tr>
					<tr>
						<td><input type="submit" name="Submit" value="Envoyer"></td>
					<tr>
				</form>
		</table>
  </body>
</html>