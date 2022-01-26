<?php

    header("Access-Control-Allow-origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,
    Authorization, X-Requested-With");

    require_once("controller/controllerApi.php");
    $traitement = new Traitement();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $donnesInsert = json_decode(file_get_contents("php://input"));
        if(!empty($donnesInsert->dateCmd) && !empty($donnesInsert->heure_debut)
         && !empty($donnesInsert->heure_fin)
        && !empty($donnesInsert->id_salle) && !empty($donnesInsert->id_personne) 
        && !empty($donnesInsert->numChaise))
        {
            $traitement->insertNewReservationEtudiant($donnesInsert); 
           
        }else{
            http_response_code();
            echo "An error allowed";
        }
    }else{
        http_response_code(503);
        echo "Service Unevailable";
    }

?>