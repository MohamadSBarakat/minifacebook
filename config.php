<?php

class Connexion{
    
    private $connexion;

function __construct(){
    $PARAM_hote = 'localhost';

    $PARAM_port = '3306';

    $PARAM_nom_bd = 'minifacebook';

    $PARAM_utilisateur = 'adminMiniFacebook';

    $PARAM_mot_passe = 'minifacebook';


    try {
        $this->connexion = new PDO(
            'mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
            $PARAM_utilisateur,
            $PARAM_mot_passe);

    } catch( Exception $e) {
        echo 'Erreur : '.$e->getMessage(). '<br />';
        echo 'N° : '.$e->getCode();
    }

     
}

public function getConnexion(){
    return $this->connexion;
}

##########################################[  getLastId  ]########################################################

public function getLastId(){
            return $this->connexion->lastInsertId();
        }

##########################################[  insert Hobby  ]########################################################
    
public function insertHobby($hobby) {

     

    try{
         $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Hobby (Type) values (:hobby)");

        $requete_prepare->execute(
            array( 'hobby' => $hobby)
        );    

        return True;
    }catch(Exception $e){
        echo 'Erreur : '.$e->getMessage(). '<br />';
            return False;

    } 
   return $connexion; 
}

###############################################[  insert Musique  ]#################################################

public function insertMusique($musique) {

   // $connexion = connexionDB();

    try { 
        $requete_prepare = $this->connexion -> prepare(
            "INSERT INTO Musique (Type) values (:musique)");

        $requete_prepare -> execute(
            array( 'musique' => $musique));    

        return True;
    }catch(Exception $e){
        echo 'Erreur : '.$e->getMessage(). '<br />';
        return False;
    }    
    
}   

####################################  [ select All Personnes ] ##################################################
public function selectAllPersonnes() {

      $requete_prepare = $this->connexion->prepare(
        "SELECT * FROM Personne");

   $requete_prepare -> execute();
   $AllPersonnes=$requete_prepare->fetchAll(PDO::FETCH_OBJ);

    return $AllPersonnes;
}

####################################  [ select All Hobbies ] ###################################################
public function selectAllHobbies() {

    $requete_prepare = $this->connexion->prepare(
        "SELECT Type FROM Hobby");

   $requete_prepare -> execute();
   $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

#################################### [ select All Musiques ] ###################################################
public function selectAllMusiques() {
   
   $requete_prepare = $this->connexion->prepare(
        "SELECT Type FROM Musique");

   $requete_prepare -> execute();
   $resultatM=$requete_prepare->fetchAll(PDO::FETCH_OBJ);

    return $resultatM;
}

####################################  [ Select Personne By Id]   ###############################################

public function selectPersonneById($id) {
   
    $requete_prepare = $this->connexion->prepare(
        "SELECT * FROM Personne WHERE ID = :id");

    $requete_prepare -> execute(array("id" => $id ));
    $resultatX=$requete_prepare->fetch(PDO::FETCH_OBJ);
    return $resultatX; 

}
 
 ####################################[ get Personne Hobby ]######################################################

public function getPersonneHobby($personneId) {

    
   $requete_prepare = $this->connexion->prepare(
        "SELECT H.Type FROM Hobby H
        INNER JOIN RelationHobby R ON R.Hobby_Id = H.ID
        WHERE R.Personne_Id = :id");

   $requete_prepare -> execute(
            array("id" => $personneId));

   $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

    return $hobbies;
}

#################################### [ get Personne Musique ] ###################################################
public function getPersonneMusique($personneId) {
     
   $requete_prepare = $this->connexion->prepare(
        "SELECT M.Type FROM Musique M
        INNER JOIN RelationMusique R ON R.Musique_Id = M.ID
        WHERE R.Personne_Id = :id");

   $requete_prepare -> execute(
            array("id" => $personneId));

   $musiques = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

    return $musiques;
}
 
####################################  [ get Relation Personne ] #################################################
       public function getRelationPersonne ($personneId) {
         
           $requete_prepare = $this->connexion->prepare(
               "SELECT R.Type, P.Nom, P.Prenom, P.URL_Photo, P.Statut_couple FROM RelationPersonne R 
               INNER JOIN Personne P ON P.ID = R.Relation_Id
               WHERE R.Personne_Id = :id");
            
            $requete_prepare -> execute(
                    array("id" => $personneId));

            $personne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

            return $personne;
        }    

####################################[ select Personne By Nom Prenom ]#########################################

      public  function selectPersonneByNomPrenomLike($pattern){
         
             
            $requete_prepare = $this->connexion->prepare(
                "SELECT * FROM Personne WHERE Nom LIKE  :nom
                                        OR Prenom LIKE  :prenom");
            
            $requete_prepare -> execute(array("nom" => "%$pattern%",
                                              "prenom" => "%$pattern%"));

            $resultatP = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

            return $resultatP;

        }

###############################[ insert Personne  ]#############################################################
function insertPersonne($nom, $prenom, $url_photo, $date_naissance, $statut_couple) {
           
        $requete_prepare = $this->connexion -> prepare(
            "INSERT INTO Personne (Nom, Prenom, URL_Photo, Date_Naissance, Statut_couple) values (:nom, :prenom, :url_photo, :date_naissance, :statut_couple)");
 
        $requete_prepare -> execute(
            array( 'nom' => $nom,
                    'prenom' => $prenom,
                    'url_photo' => $url_photo,
                    'date_naissance' => $date_naissance,
                    'statut_couple' => $statut_couple)); 

                    // getLastId();
            

       //  return $id;
           
 } 

##############################################[ insertRelationHobbies ]########################################


  function insertPersonneHobbies($personne_Id, $hobby_Id) {

    try { 
      $requete_prepare = $this->connexion -> prepare(
          "INSERT INTO RelationHobby(Personne_Id, Hobby_Id) values (:personne_id, :hobby_id)");
      $requete_prepare -> execute(
          array( 'personne_id' => $personne_Id,
                 'hobby_id' => $hobby_Id));    

      return True;
    }catch(Exception $e){
        echo 'Erreur : '.$e->getMessage(). '<br />';
        return False;
    }    
      
  } 

##############################################[ insertRelationMusique ]########################################


  function insertPersonneMusiques($personne_Id, $musique_Id) {

    try { 
      $requete_prepare = $this->connexion -> prepare(
          "INSERT INTO RelationMusique(Personne_Id, Musique_Id) values (:personne_id, :musique_id)");
      $requete_prepare -> execute(
          array( 'personne_id' => $personne_Id,
                 'musique_id' => $musique_Id));    

      return True;
    }catch(Exception $e){
        echo 'Erreur : '.$e->getMessage(). '<br />';
        return False;
    }    
      
  } 

##############################################[ insertPersonneRelation  ]########################################


  function insertPersonneRelation($personne_Id, $relation_Id, $type) {

    try { 
      $requete_prepare = $this->connexion -> prepare(
          "INSERT INTO RelationPersonne(Personne_Id, Relation_Id, Type) values (:personne_id, :relation_id, :type)");
      $requete_prepare -> execute(
          array( 'personne_id' => $personne_Id,
                 'relation_id' => $relation_Id,
                 'type'        => $type));    

      return True;
    }catch(Exception $e){
        echo 'Erreur : '.$e->getMessage(). '<br />';
        return False;
    }    
      
  } 

##############################################[ Get Hobby By ID ]########################################

    function getHobbyId($hobby) {
     
      $requete_prepare = $this->connexion -> prepare(
          "SELECT * FROM Hobby WHERE Type = :hobby");
      $requete_prepare -> execute(array('hobby' => $hobby));    

        $hobbyId=$requete_prepare->fetch(PDO::FETCH_OBJ);

            return $hobbyId;  

    }


##############################################[ Get Hobby By ID ]########################################

    function getMusiqueId($musique) {
     
      $requete_prepare = $this->connexion -> prepare(
          "SELECT * FROM Musique WHERE Type = :musique");
      $requete_prepare -> execute(array('musique' => $musique));    

        $musiqueId=$requete_prepare->fetch(PDO::FETCH_OBJ);

            return $musiqueId;  

    }

##############################################[ Get Chekbox Value ]########################################
    function getCheckBoxValue() {
            $id = 23;
        if(isset($_POST['submit'])){
            if(!empty($_POST['check_list'])) {

                foreach($_POST['hobbies'] as $selected) {

                    getHobbyId($selected);

                    insertPersonneHobbies($id, $hobby_Id);
                }
        }
            }        


    }
 
 ##############################################[ inscription ]########################################   

   public function inscription(){

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


}
?>