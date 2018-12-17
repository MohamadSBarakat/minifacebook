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


    <!-- <?php  $appliBD->####insertPersonne($_POST["nom"], $_POST["Prenom"],
		 $_POST#######["photoProfil"], $_POST["dateNaissance"], $_POST["status"]); ?>  -->


	<!-- barre continu en-tête avec les liens -->
	<div id="top_head">
		<a href="listeContact.php">
			<div class="droite">
				Liste des profils
			</div>
		</a>
		<a href="AjoutProfil.php">
			<div class="droite">
				Ajouter un profil
			</div>
		</a>
	</div>
	<!-- Div contenant le titre de la page ainsi que le formulaire d'ajout d'un nouveau contact et la list des contacts en dessous-->
	 
	<div id="Contenu">
				
            <div id = "profil-header">
               <div id = "profil-data">
               		<?php $getPersonneById = $appliBD->selectPersonneById($_GET["id"]); ?>
	                <?php echo "<img class=img_profil src=$getPersonneById->URL_Photo alt=Photo de profil width=120 height=120>" ?>
	                <p><?php echo $getPersonneById->Prenom . '  ' . $getPersonneById->Nom;?></p>
	                <p><?php echo $getPersonneById->Date_Naissance; ?></p>
	                <p><?php echo $getPersonneById->Statut_couple;?></p> 
				</div>    

            </div>

            <div id = "activite">  
                <h2>Activité</h2>
                 
                <div id="contenu_musique">
                        <h4>Musique</h4>
                
                <div  id="musique">	
                       
 
				<?php
				$personneMusique = $appliBD->getPersonneMusique($_GET["id"]);
	            echo   "<ul>";
	            foreach ($personneMusique  as  $musiques) {
                 echo "<li>" . $musiques->Type . "</li>";         
                }        
                echo    "</ul>";
                ?>

                </div>
                </div> 
                
                <div id="contenu_hobbies">
                            <h4>Hobbies</h4>

                <div id = "hoppies">
                        
 				<?php
				$personneHobby = $appliBD->getPersonneHobby($_GET["id"]);
                echo    "<ul>";
	                foreach ($personneHobby  as  $hobbies) {
		                echo "<li>" . $hobbies->Type . "</li>";	
		                }                
		                echo    "</ul>";
                ?>
                </div>
            </div>

            </div>

            <div id = "contact">
            	<h2>Relation</h2>


    			<?php	
    			$relationPersonne = $appliBD->getRelationPersonne($_GET["id"]);
                foreach ($relationPersonne  as  $relation) {
	                echo "<div class=listeContactsRelation >";
					echo "	<img class=imageContact src=$relation->URL_Photo> ";
						echo "<p>";
							echo $relation->Prenom . '  ' . $relation->Nom;
					echo "	</p>"; 
					echo "	<p>";
					echo $relation->Statut_couple;
					echo "	</p>"; 
					echo "	<p>";
					echo $relation->Type;
					echo "	</p>";
		 		}
				echo "	</div>";
				?>
			 
            </div>


		
		

		

	


















</body>
</html>