<html>
  <head>
   <link rel="stylesheet" href="assets/css/bootstrap.css" />
		<script type="text/javascript">
			function noBack(){window.history.forward()}
			noBack();
			window.onload=noBack;
			window.onpageshow=function(evt){if(evt.persisted)noBack()}
			window.onunload=function(){void(0)}
		</script>	
	</head>	
  <body>
		<h2>MusicApps</h2>
    <table>
			<form method="post" action="Connecter/traitement">
				<tr>
					<td>email :</td> 
					<td><input style="height:40px" type="text" name="email"></td>
				</tr>	
				<tr>
					<td>mot de passe :</td>
					<td><input style="height:40px" type="password" name="mdp"></td>
				</tr>
				<tr>
					<td><input type="submit" name="connexion" value="connexion"></td>
					<td><a href="inscription">s'inscrire</a></td>	
				</tr>
			</form>
		</table>
		<?php
			if($connexion==false){
				
				echo "<p>L’e-mail ou le mot de passe entré</p> 
							<p>ne correspond à aucun compte.</p>
							<p><a href='inscription'>Veuillez créer un compte.</a></p>";
				
			}
		?>
  </body>
</html>