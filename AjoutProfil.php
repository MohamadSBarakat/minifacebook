<!doctype html>
<html lang="fr">

<head>
	 <meta charset="utf-8">
	 <meta http-equiv="x-ua-compatible" content="ie=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link href="style2.css" rel="stylesheet">
	 <title>Annuaire - Ajouter un contact</title>
	 <?php  require('config.php'); ?> 
	 <?php  $appliBD = new Connexion(); ?> 

  
</head>

<body>

		<?php $id = 23;
        if(isset($_POST['submit'])){
            if(!empty($_POST['hobbies'])) {

                foreach($_POST['hobbies'] as $selected) {

                    $appliBD->getHobbyId($selected);

                    $appliBD->insertPersonneHobbies($id, $hobby_Id);
                    }}} ?>
	 

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
		<h1>Ajouter un contact</h1>

	<!--	<form method="get" action="annuaireProfil.php?id=$personnes->ID" >  -->
			<form method="POST" type="submit"  action="AjoutProfil.php?id=$personnes->ID" >
		<table>
			<tr>
				<td>URL Photo :</td>
				<td class="textAlignRight"> <input type="url" name="photoProfil" placeholder="URL de votre photo"  ></td></td>
			</tr>
			<tr>
				<td>Nom :</td>
				<td class="textAlignRight"> <input type="text" name="nom" placeholder="Votre nom"  ></td>
			</tr>
			<tr>
				<td>Prénom :</td>
				<td class="textAlignRight"> <input type="text" name="Prenom" placeholder="Votre prénom"  ></td>
			</tr>
			<tr>
				<td>Date de naissance :</td>
				<td class="textAlignRight"> <input class="date" type="date" name="dateNaissance"  ></td>
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
			<?php  $allHobbies = $appliBD->selectAllHobbies();
			        foreach ($allHobbies as  $hobb) {
					echo  '<input type="checkbox" name="hobbies[]" value="">' . $hobb->Type;
					 } 
				?>			
				 
				</td>
			</tr>
			<tr>
				<td>Musique :</td>
				<td class="textAlignRight">
					<?php  $allMusiques = $appliBD->selectAllMusiques();
			        foreach ($allMusiques as  $musique) {
					echo '<input type="checkbox" name="musiques[]" value="">' . $musique->Type;
					 } 
					?>	
				 
				</td>
	</tr>
   
			<tr>
				<td class="boutonCentrer" colspan="2">
					<input type="submit" value="Ajouter le contact">
				</td>
			</tr>

		</table>
				
			<div class="Contacts clair">
				<img class="imageContact" src="imgs/avatar_defaut.png"> 
				<p>
					JEAN-PHILLIPE DE MARINIAQUE - CELIBATAIRE
				</p> 
				<p>
					<input type="checkbox" name="Famille">Famille
					<input type="checkbox" name="Collegue">Collegue
					<input type="checkbox" name="Ami">Ami
				</p>
			</div>


			<div class="Contacts fonce">
				<img class="imageContact" src="imgs/avatar_defaut.png"> 
				<p>
					JEAN-PHILLIPE DE MARINIAQUE - CELIBATAIRE
				</p> 
				<p>
					<input type="checkbox" name="Famille">Famille
					<input type="checkbox" name="Collegue">Collegue
					<input type="checkbox" name="Ami">Ami
				</p>
			</div>

			<div class="Contacts fonce">
				<img class="imageContact" src="imgs/avatar_defaut.png"> 
				<p>
					JEAN-PHILLIPE DE MARINIAQUE - CELIBATAIRE
				</p> 
				<p>
					<input type="checkbox" name="Famille">Famille
					<input type="checkbox" name="Collegue">Collegue
					<input type="checkbox" name="Ami">Ami
				</p>
			</div>

			<div class="Contacts fonce">
				<img class="imageContact" src="imgs/avatar_defaut.png"> 
				<p>
					JEAN-PHILLIPE DE MARINIAQUE - CELIBATAIRE
				</p> 
				<p>
					<input type="checkbox" name="Famille">Famille
					<input type="checkbox" name="Collegue">Collegue
					<input type="checkbox" name="Ami">Ami
				</p>
			</div>

		</form>

	</div>

</body>
</html>