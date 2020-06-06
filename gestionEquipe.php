<?php
    try{  

        $connect = new PDO('pgsql:host=localhost ;port=5432; dbname=postgres', 'projet', '');
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $connect->exec('SET search_path TO public, projet');

        /*$sql = $connect->prepare('SELECT * FROM benevole');
        $sql->execute();
        while($rs = $sql->fetch()){
            echo $rs['nom']."------";
        }
        echo"---------------------------------------------".'<br>'.'<br>'.'<br>';
        */

    } catch(Exception $e){
        echo "Erreur de connexion: ".$e->getMessage();
        die(); // pour interrompre le traitement d'une requete
    }
?>

<?php
    if(isset($_POST['suivantP'])){
        
        if(isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['datenaissance']) AND isset($_POST['mail']) AND isset($_POST['tel']) AND isset($_POST['adresse']) AND isset($_POST['club'])   ){
            $nom = $_POST['firstname'];
            $prenom = $_POST['lastname'];
            $date = $_POST['datenaissance'];
            $mail = $_POST['mail'];
            $tel = $_POST['tel'];
            $adresse = $-POST['adresse'];
            $club = $_POST['club']
            $permis = $_POST['permis'];

            inscriptionParticipant($nom, $prenom, $date, $tel, $mail, $adresse, )
        }
    }

?>

<?php
    function inscriptionParticipant($connect, $nom, $prenom, $date, $tel, $mail, $adresse){
        $connect->prepare('INSERT INTO participant (nom, prenom, date_naiss, telephone, email, adresse, attestation_ok, frais_paye, repas_supplementaire, id_velo, valider) 
                                VALUE (:nom, ;prenom, date_naiss, telephone, email, adresse, attestations_ok, frais_paye, repas_supplementaire, id_velo, valider)' );
        $attestation = 'true';
        $frais = 0;
        $repasSup = 0;
        $idVelo = 0;
        $valider = 'false';

        $connect->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naiss' => $date,
            'telephone' => $tel,
            'email' => $mail,
            'adresse' => $adresse,
            'attestations_ok' => $attestation,
            'frais_paye' => $frais,
            'repas_supplementaire' => $repasSup,
            'id_velo' => $idVelo,
            'valider' => $valider
        ));
    }
?>