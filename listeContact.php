<!doctype html>
<html lang="fr">

	<head>
		 <meta charset="utf-8">
		 <meta http-equiv="x-ua-compatible" content="ie=edge">
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		 <link href="style2.css" rel="stylesheet">
		 <title>Annuaire - Ajouter un contact</title>
		 <?php  require('config.php'); ?> 
		 <?php  $appliDB = new Connexion(); ?> 
				 
	</head>

	<body>

		<!-- barre continu en-tête avec les liens -->
		<div id="top_head">
			<a href="AjoutProfil.php">
				<div class="droite">
					Ajouter un profil
				</div>
			</a>
		</div>
		<!-- Div contenant le titre de la page ainsi que le formulaire d'ajout d'un nouveau contact et la list des contacts en dessous-->
		<div id="Contenu">
			<h1>Liste des contacts</h1>
			<form action="listeContact.php" class="formulaireRecherche" method="GET">
	               <input class="champRecherche"  type="text" name="cherchNom"   placeholder="Rechercher un profil"/>
	               <input class="boutonRecherche" type="submit"  value="Rechecher" />
	                     
	        </form>
	        <div class=relation_Scroll>
		<?php

			if (!($_GET)) {
				$AllPersonnes = $appliDB->selectAllPersonnes(); 													
      			foreach ($AllPersonnes  as  $personnes) {
			//	echo	"<div>";			
				echo	"<a href=annuaireProfil.php?id=$personnes->ID>";
				echo	"<div class=listeContacts>"; 
				echo		"<img class=\"imageContact\" src=\"$personnes->URL_Photo\">"; 
				echo		"<p>" . $personnes->Prenom . '  ' . $personnes->Nom	. "</p>"; 
				echo		"<p>";
				echo			$personnes->Statut_couple;
				echo		"</p>";
				echo	"</div>"; 
	        }		
		//		echo	"</div>"; 
				echo	"</a>";
	   	        }  	

			elseif(isset($_GET)) {
				$resultatP = $appliDB->selectPersonneByNomPrenomLike($_GET["cherchNom"]);
				foreach ($resultatP  as  $personnes) {
		    	echo	"<div>";			
				echo	"<a href=annuaireProfil.php?id=$personnes->ID>";
				echo	"<div class=listeContacts>"; 
				echo		"<img class=\"imageContact\" src=\"$personnes->URL_Photo\">"; 
				echo		"<p>" . $personnes->Prenom . '  ' . $personnes->Nom	. "</p>"; 
				echo		"<p>";
				echo			$personnes->Statut_couple;
				echo		"</p>";
				echo	"</div>"; 
	        }		
	   	  		echo	"</div>"; 
				echo	"</a>";		
			}  
			?>
			</div>
		</div>

	</body>
</html>