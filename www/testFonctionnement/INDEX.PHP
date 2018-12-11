
<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>Test de UWAMP</title>
	</head>
	<body>
		<?php
		Echo "PHP fonctionne !!<br/>";
		Echo "<br/>";
		Echo "<br/>";
		Echo "Test de mysql :<br/>";
		$PARAM_hote='localhost'; // le chemin vers le serveur
		$PARAM_port='3306';
		$PARAM_nom_bd='basetest'; // le nom de votre base de données
		$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
		$PARAM_mot_passe='root'; // mot de passe de l'utilisateur pour se connecter

		try
		{
				$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
		}
		 
		catch(Exception $e)
		{
				Echo "MySql NE FONCTIONNE PAS !!<br/>";
				echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();
				exit();
		}
		Echo "MySql fonctionne !!<br/>";
		$connexion->exec('SET NAMES utf8');
		?>
		<br/><br/>Test de l'extraction depuis la base. Vous devriez obtenir : <br/>
		Utilisateur : 1 Dupont Marcel 23 <br/>
		Utilisateur : 2 Durand Pierre 21<br/>
		Utilisateur : 5 Accentués àéçïêè 42<br/>
		<br/>
		Résultat : <br/>
		<?php 
		try{
			$resultats=$connexion->query("SELECT id,nom,prenom,age FROM tabletest ORDER BY id ASC"); // on va chercher tous les membres de la table qu'on trie par ordre croissant
			$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
			while( $ligne = $resultats->fetch() ) // on récupère la liste des membres
			{
					echo 'Utilisateur : '.$ligne->id.' '.$ligne->nom.' '.$ligne->prenom.' '.$ligne->age.'<br />'; // on affiche les membres
			}
			$resultats->closeCursor(); // on ferme le curseur des résultats
		}
		catch(Exception $e)
		{
				Echo "Impossible de d'extraire depuis la BD !!<br/>";
				echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();
				exit();
		}
		?>

	</body>
</html>