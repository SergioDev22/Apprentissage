<?php
	header("Access-Control-Allow-origin: *");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,
	Authorization, X-Requested-With");


	require_once("controller/controllerApi.php");
	$traitement = new Traitement();
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$salleAutreDispo = $traitement->getSalleAutreDispo();
        http_response_code(200);
		echo $salleAutreDispo;
	}else{
		http_response_code(405);
		echo "Method Not Allowed";
	}
?>