<?php

    header("Access-Control-Allow-origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,
    Authorization, X-Requested-With");

    require_once("controller/controllerApi.php");
    $traitement = new Traitement();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $donnesInsert = json_decode(file_get_contents("php://input"));
        if(!empty($donnesInsert->email) && !empty($donnesInsert->mdp)){
            $traitement->verifLoginEtudiant($donnesInsert);
        }else{
            echo "not complete information";
        }
    }else{
        http_response_code(503);
        echo "Service Unevailable";
    }

?>