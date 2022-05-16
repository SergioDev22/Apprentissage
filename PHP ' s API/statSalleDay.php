<?php

    header("Access-Control-Allow-origin: *");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,
	Authorization, X-Requested-With");

    require_once("controller/controllerWebAdmin.php");
	$traitement = new Traitement();

	if($_SERVER["REQUEST_METHOD"]=="POST"){
        $donnesInsert = json_decode(file_get_contents("php://input"));
        if(!empty($donnesInsert->date) && !empty($donnesInsert->idTypeSalle)){
            $salleStatDay = $traitement->statSalleDay($donnesInsert->date,intval($donnesInsert->idTypeSalle));
			echo $salleStatDay;
		    http_response_code(200);
        }else{
            echo "Empty information posted\n
            Please,verify!!!";
        }
	}else{
		http_response_code(405);
		echo "Method Not Allowed";
	}

?>