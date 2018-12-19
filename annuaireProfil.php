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

		<?php
		if ($_POST)
		{
  	    	$hobbysId=$_POST['hobbies'];
    		$musiquesId=$_POST['musiques'];
    		$relationType=$_POST['relation'];
 
    		$appliDB->insertPersonne($_POST["nom"], $_POST["Prenom"],
     		$_POST["photoProfil"], $_POST["dateNaissance"], $_POST["status"]);
    		$personne_id=$appliDB->getLastId();
      
    		foreach($hobbysId as $hobby){
    			$hobbyId =  $appliDB->getHobbyId($hobby);
    			$hID     = $hobbyId->ID;
        		$appliDB->insertPersonneHobbies($personne_id, $hID);
    		}

    		foreach($musiquesId as $musique){
    			$musiqueId =  $appliDB->getMusiqueId($musique);
    			$mID     = $musiqueId->ID;
        		$appliDB->insertPersonneMusiques($personne_id, $mID );
    		} 
    
    		foreach($relationType as $relation_id => $rt){
      			if ($rt !== ' ')
      			{
      				$appliDB->insertPersonneRelation($personne_id,$relation_id,$rt);
      			}  
   	   	    }
		} 
		else { $personne_id = $_GET["id"];
	   
	    }
    	?>
	
	<div id="top_head">
		<a href="listeContact.php">	<div class="droite">Liste des profils</div></a>
		<a href="AjoutProfil.php">	<div class="droite">Ajouter un profil</div></a>
	</div>
	
	<div id="Contenu">
				
            <div id = "profil-header">
               <div id = "profil-data">
               	     
               		<?php $getPersonneById = $appliDB->selectPersonneById($personne_id); ?>
	                <?php echo "<img class=img_profil src=\"$getPersonneById->URL_Photo\" alt=Photo de profil width=120 height=120>" ?>
	                <p><?php echo $getPersonneById->Prenom . '  ' . $getPersonneById->Nom;?></p>
	                <p><?php echo $getPersonneById->Date_Naissance; ?></p>
	                <p><?php echo $getPersonneById->Statut_couple;?></p> 
				</div>    
            </div>

            <div id = "activite">  <h2>Activité</h2>
                 
                <div id="contenu_musique">   <h4>Musique</h4>
                
                <div  id="musique">	
                       
 					<?php
					$personneMusique = $appliDB->getPersonneMusique($personne_id);
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
					$personneHobby = $appliDB->getPersonneHobby($personne_id);
                		echo    "<ul>";
	                		foreach ($personneHobby  as  $hobbies) {
		               			 echo   "<li>" . $hobbies->Type . "</li>";	
		             	    }                
		                echo    "</ul>";
               		?>
                </div>
          	    </div>
                </div>

            <div id = "contact">
            	<h2>Relation</h2>
    			<?php	
    			$relationPersonne = $appliDB->getRelationPersonne($personne_id);
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