<?php
    try{  

        $connect = new PDO("pgsql:dbname=postgres;host=localhost", "projet", "");
        //$connect = pg_connect("host=localhost port=5432 dbname=postgres user=projet");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        var_dump($_POST);
    } catch(Exception $e){
        echo "Erreur de connexion: ".$e->getMessage()."<br/>";
        die(); // pour interrompre le traitement d'une requete
    }

    
?>

<?php
/****************************** recuperation des donnees du formaulaire Benevoles *************************/ 
    try{
        if(isset($_POST['inscrireB'])){

            if(isset($_POST['firstnom']) AND isset($_POST['lastprenom']) AND isset($_POST['datenaissance']) 
                         AND isset($_POST['mail']) AND isset($_POST['tel']) AND isset($_POST['poste']) ){
                 var_dump('insertion 1');
                 inscription_Benevole($connect, $_POST['firstnom'], $_POST['lastprenom'], $_POST['adresse'], $_POST['mail'], $_POST['poste'], 
                                     $_POST['datenaissance'], $_POST['permis'] );
             } 
     
             var_dump('insertion');
             //header("location:index.php");
             exit();
         }  
    }catch(Exception $e){
        echo "Erreur de connexion: ".$e->getMessage()."<br/>";
        die(); // pour interrompre le traitement d'une requete
    }
    
?>

<?php
/****************************** Inscription dans la base de donnees *************************/ 
    
    function inscription_Benevole($connect, $nom, $prenom, $adresse, $mail, $poste, $dateN, $permis){
        var_dump('fonction 1');
         $insert = $connect->prepare('INSERT INTO benevole(nom, prenom, adresse, email, id_poste, permis_conduire, date_naissance, type_benevole) 
                                     VALUES(:nom, :prenom, :adresse, :email, :id_poste, :permis_conduire, :date_naissance, :type_benevole)');
        $idPoste = 1;
        $typeBenevole = 2;
        var_dump('insertion 2');
        $insert ->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'adresse' => $adresse,
            'email' => $mail,
            'id_poste' => $idPoste,
            'permis_conduire' => $permis,
            'date_naissance' => $dateN,
            'type_benevole' => $typeBenevole
        ));
        var_dump('insertion 3');

        posteSouhaiter($connect, $poste, $nom, $prenom);
        var_dump('insertion 4');

    }

    function posteSouhaiter($connect, $poste, $nomB, $prenomB){
        var_dump('insertion 5');
        $insert = $connect->prepare('INSER INTO posteSouhaiter (poste, nom, prenom, idBenevole) 
                                VALUES(:poste, :nom, :prenom, :idBenevole)');
                                var_dump('insertion 6');
        $idB = 1;
        $insert->execute(array(
            'poste' => $poste,
            'nom' => $nomB,
            'prenom' => $prenomB,
            'idBenevole' => $idB
        ));
        var_dump('insertion 7');
    }
?>

<?php
    /*function ajout_utilisateur($connect, $login, $password, $droit){
        $ajout = $connect->prepare('INSERT INTO utilisateur(login, password, droit) VALUES(:login, :password, :droit)');
        $ajout->execute(array(
            'login' => $login,
            'password' => $password,
            'droit' => $droit
        ));
    }*/
?>