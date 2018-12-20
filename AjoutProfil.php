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
		<a href="listeContact.php" >
			<div class="droite">
				Liste des profils
			</div>
		</a>
	</div>
	<!-- Div contenant le titre de la page ainsi que le formulaire d'ajout d'un nouveau contact et la list des contacts en dessous-->
	<div id="Contenu">
		<h1>Inscription</h1>

	<!--	<form method="get" action="annuaireProfil.php?id=$personnes->ID" >  -->
			<form method="POST"    action="annuaireProfil.php" >
		<table>
			<tr>
				<td>URL Photo :</td>
				<td class="textAlignRight"> <input type="url" name="photoProfil" placeholder="URL de votre photo" required></td></td>
			</tr>
			<tr>
				<td>Nom :</td>
				<td class="textAlignRight"> <input type="text" name="nom" placeholder="Votre nom" required ></td>
			</tr>
			<tr>
				<td>Prénom :</td>
				<td class="textAlignRight"> <input type="text" name="Prenom" placeholder="Votre prénom" required></td>
			</tr>
			<tr>
				<td>Date de naissance :</td>
				<td class="textAlignRight"> <input class="date" type="date" name="dateNaissance" required></td>
			</tr>
			<tr>
				<td>Statut :</td>
				<td class="textAlignRight"> 
					<select name="status">
						<option value="En couple">En couple</option>
						<option value="Celibataire">Célibataire</option>
						<option value="Non defini">Non defini</option>
					</select>
				</td>
			</tr>
	 
	<tr>
 		<td>Hobbies :</td>
		<td class="textAlignRight">
			<?php  $allHobbies = $appliDB->selectAllHobbies();?>
			<input type="checkbox" name="hobbies[]" value=<?php echo $allHobbies[0]->Type?>><?php echo $allHobbies[0]->Type?> 
			<input type="checkbox" name="hobbies[]" value=<?php echo $allHobbies[1]->Type?>><?php echo $allHobbies[1]->Type?>
			<input type="checkbox" name="hobbies[]" value=<?php echo $allHobbies[2]->Type?>><?php echo $allHobbies[2]->Type?>
			<input type="checkbox" name="hobbies[]" value=<?php echo $allHobbies[3]->Type?>><?php echo $allHobbies[3]->Type?>
			<input type="checkbox" name="hobbies[]" value=<?php echo $allHobbies[4]->Type?>><?php echo $allHobbies[4]->Type?>
			       
			        <!--  foreach ($allHobbies as  $hobb) {  
					//echo  "<label><input type=\"checkbox\" name=\"hobbies[]\" value=\"$hobb->Type\">$hobb->Type</label>";
					// } -->
									 
				</td>
			</tr>
		<tr>
			<td>Musique :</td>
			<td class="textAlignRight">

			<?php  $allMusiques = $appliDB->selectAllMusiques();?>	
			<input type="checkbox" name="musiques[]" value=<?php echo $allMusiques[0]->Type?>><?php echo $allMusiques[0]->Type?>
			<input type="checkbox" name="musiques[]" value=<?php echo $allMusiques[1]->Type?>><?php echo $allMusiques[1]->Type?>
			<input type="checkbox" name="musiques[]" value=<?php echo $allMusiques[2]->Type?>><?php echo $allMusiques[2]->Type?>
			<input type="checkbox" name="musiques[]" value=<?php echo $allMusiques[3]->Type?>><?php echo $allMusiques[3]->Type?>
			<input type="checkbox" name="musiques[]" value=<?php echo $allMusiques[4]->Type?>><?php echo $allMusiques[4]->Type?>	
			    <!--    foreach ($allMusiques as  $musique) {
					echo "<input type=\"checkbox\" name=\"musiques[]\" value=\"$musique->Type>" . $musique->Type;
					 } -->
					
				 
				</td>
	</tr>
   
			<tr>
				<td class="boutonCentrer" colspan="2">
					<input type="submit"  name="submit" value="Ajouter le contact">
				</td>
			</tr>

		</table>
			<div class=relation_Scroll>		
			<?php
			$AllPersonnes    = $appliDB->selectAllPersonnes(); 													
      		foreach ($AllPersonnes  as  $personnes) {
					
			  	echo	"<div class=Contacts>"; 
				echo		"<img class=imageContact src=$personnes->URL_Photo>"; 
				echo		"<p>" . $personnes->Prenom . '  ' . $personnes->Nom	. "</p>"; 
			    echo		"<p>";
				echo		"<select name=\"relation[$personnes->ID]\">";
				echo		"<option value=\" \">Non defini</option>";
				echo		"<option value=\"Famille\">Famille</option>";
				echo		"<option value=\"Collegue\">Collegue</option>";
				echo		"<option value=\"Ami\">Ami</option>";
				 
				echo		"</select>";
				echo		"</p>";
				/*echo	"</div>"; */
				 
				echo	"</div>"; 
	        }		
			
			?>
		 	</div> 
			 
			 			

  <!--
 		< ?php $id = 12;
                  
        if(isset($_POST['submit'])){
		 	if(!empty($_POST['hobbies'])) {			 
            foreach($_POST['hobbies'] as $selected) {
		 		echo "<p>".$selected ."</p>";
            	$hobbyId =  $appliDB->getHobbyId($selected);       
            	$hID     = $hobbyId->ID;
            	$appliDB->insertPersonneHobbies($id, $hID);
					
				}	 
            }
		 	
        if(!empty($_POST['musiques'])) {			 
            foreach($_POST['musiques'] as $selected) {
		 		echo "<p>".$selected ."</p>";
            	$musiqueId =  $appliDB->getMusiqueId($selected);       
            	$mID     = $musiqueId->ID;
            	$appliDB->insertPersonneMusiques($id, $mID);
					
				}	 
            }
		 
         if(!empty($_POST['relation'])) {  
         $relationType=$_POST['relation'];  
         foreach($relationType as $relation_Id => $rt) {
		 		             	 
		 		if ($rt !== ' ')
		 		{
              	$appliDB->insertPersonneRelation($id, $relation_Id, $rt);
              	echo "<p>".$relation_Id .  $rt ."</p>";
              	} 
}
        }

    }
    	?>
         
-->


		</form>

	</div>

</body>
</html>