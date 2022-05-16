<?php

    
    header("Content-type: application/jspn; charset=UTF-8");
    require_once("Model/modelApi.php");

    class Traitement{
        public function getAllSalle(){
            try{
                $query = new query_data();
                $req = $query->getAllSalle();
                $data = $req->fetchAll();
                $finalData["Salle"] = []; 
                foreach($data as $value){
                    $req2 = $query->getMateriel($value["id_salle"]);
                    $data2 = $req2->fetchAll();
                    $finalDataMateriel = [];
                    foreach($data2 as $dataMateriel){
                            $finalDataMateriel[] = [
                            "Nom du materiel" => $dataMateriel["nomMateriel"],
                            "nombre" => $dataMateriel["nombre"]
                        ];
                    }
                    $finalData["Salle"][] = [
                        "id" => $value["id_salle"],
                        "Nom de la salle"  => $value["nomSalle"],
                        "Capacite de la salle" => $value["capacite"],
                        "statut" => $value["prise"],
                        "Photo de couverture" => $value["photoDeCouverture"],
                        "Type de la salle" => $value["nom_type"],
                        "Materiel" => $finalDataMateriel
                    ];
                }
                
                return json_encode($finalData,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

    
        public function getSalleReserveProf(){
            try{
                $query = new query_data();
                $req = $query->getSalleReserveProf();
                $data = $req->fetchAll();
                $dataSalleReserveProf["Salle Professeur Reserve "] = [];
                foreach($data as $value){
                    $dataSalleReserveProf["Salle Professeur Reserve "][]=[
                        "Nom de la Salle" => $value["nomSalle"],
                        "Capacité" => $value["capacite"],
                        "Photo de Couverture"=> $value["photoDeCouverture"],
                        "Heure de debut " => $value["heure_debut"],
                        "Heure de Fin" => $value["heure_fin"],
                        " Nom du Professeur" => $value["nom"],
                        "Prenom du Professeur" => $value["prenom"]
                    ];
                }
                return json_encode($dataSalleReserveProf,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            } 
        }
    
        public function getSalleReserveEtudiant(){
            try{
                $query = new query_data();
                $req = $query->getSalleReserveEtudiant();
                $data = $req->fetchAll();
                $dataSalleEtudiantReserve["Salle Etudiant"] = [];
                foreach($data as $value){
                    $dataSalleEtudiantReserve["Salle Etudiant"][]=[
                        "Nom de la Salle" => $value["nomSalle"],
                        "Capacité" => $value["capacite"],
                        "Photo de Couverture"=> $value["photoDeCouverture"],
                        "Heure de debut " => $value["heure_debut"],
                        "Heure de Fin" => $value["heure_fin"],
                        " Nom de l'etudiant" => $value["nom"],
                        "Prenom de l'etudiant" => $value["prenom"],
                        "Numero de la chaise" => $value["numChaise"]
                    ];
                }
                return json_encode($dataSalleEtudiantReserve,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    
        public function getSalleReserveAutre(){
            try{
                $query = new query_data();
                $req = $query->getSalleReserveAutre();
                $data = $req->fetchAll();
                $dataSalleAutreReserve["Salle Autre Reserve"] = [];
                foreach($data as $value){
                    $dataSalleAutreReserve["Salle Autre Reserve"][]=[
                        "Nom de la Salle" => $value["nomSalle"],
                        "Capacité" => $value["capacite"],
                        "Photo de Couverture"=> $value["photoDeCouverture"],
                        "Heure de debut " => $value["heure_debut"],
                        "Heure de Fin" => $value["heure_fin"],
                        " Nom de la personne" => $value["nom"],
                        "Prenom de la personne" => $value["prenom"],
                        "Nom de l'organisation" => $value["organisation"]
                    ];
                }
                return json_encode($dataSalleAutreReserve,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    
        public function getSalleProfDispo(){
            try{
                $query = new query_data();
                $req = $query->getSalleProfDispo();
                $data = $req->fetchAll();
                $dataSalleProfDispo["Salle Prof Dispo"] = []; 
                foreach($data as $value){
                    $req2 = $query->getMateriel($value["id_salle"]);
                    $data2 = $req2->fetchAll();
                    $finalDataMateriel = [];
                    foreach($data2 as $dataMateriel){
                            $finalDataMateriel[] = [
                            "Nom du materiel" => $dataMateriel["nomMateriel"],
                            "nombre" => $dataMateriel["nombre"]
                        ];
                    }
                    $dataSalleProfDispo["Salle Prof Dispo"][] = [
                        "id" => $value["id_salle"],
                        "Nom de la salle"  => $value["nomSalle"],
                        "Capacite de la salle" => $value["capacite"],
                        "Photo de couverture" => $value["photoDeCouverture"],
                        "Materiel" => $finalDataMateriel
                    ];
                }
                return json_encode($dataSalleProfDispo,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    
        public function getSalleAutreDispo(){
            try{
                $query = new query_data();
                $req = $query->getSalleAutreDispo();
                $data = $req->fetchAll();
                $dataSalleAutreDispo["Salle Prof Dispo"] = []; 
                foreach($data as $value){
                    $req2 = $query->getMateriel($value["id_salle"]);
                    $data2 = $req2->fetchAll();
                    $finalDataMateriel = [];
                    foreach($data2 as $dataMateriel){
                            $finalDataMateriel[] = [
                            "Nom du materiel" => $dataMateriel["nomMateriel"],
                            "nombre" => $dataMateriel["nombre"]
                        ];
                    }
                    $dataSalleAutreDispo["Salle Prof Dispo"][] = [
                        "id" => $value["id_salle"],
                        "Nom de la salle"  => $value["nomSalle"],
                        "Capacite de la salle" => $value["capacite"],
                        "Photo de couverture" => $value["photoDeCouverture"],
                        "Materiel" => $finalDataMateriel
                    ];
                }
                return json_encode($dataSalleAutreDispo,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    
        public function getMateriel($id_salle){
            try{
                $query = new query_data();
                $req = $query->getMateriel($id_salle);
                $data = $req->fetchAll();
                return json_encode($data,JSON_PRETTY_PRINT);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function insertNewReservation($donnesInsert){
            $query = new query_data();
            if(!empty($donnesInsert->dateCmd) && !empty($donnesInsert->heure_debut)
            && !empty($donnesInsert->heure_fin)&& !empty($donnesInsert->id_salle) &&
            !empty($donnesInsert->id_personne))
            {
                $idSalle = htmlspecialchars(strip_tags(intval($donnesInsert->id_salle)));
                $dateDebut = htmlspecialchars(strip_tags($donnesInsert->dateCmd));
                $heureDebut = htmlspecialchars(strip_tags($donnesInsert->heure_debut));
                $heureFin = htmlspecialchars(strip_tags($donnesInsert->heure_fin));
                $idPersonne = htmlspecialchars(strip_tags(intval($donnesInsert->id_personne)));
                $req = $query->insertNewReservation($dateDebut,$heureDebut,$heureFin ,$idSalle,$idPersonne);

                http_response_code(201);
                return "Insertion success"; 
            }else{
                http_response_code();
                return "An error allowed";
                echo "non";
            }
       
        }

        public function insertNewReservationEtudiant($donnesInsert){
            $query = new query_data();

            $idSalle = htmlspecialchars(strip_tags(intval($donnesInsert->id_salle)));
            $dateDebut = htmlspecialchars(strip_tags($donnesInsert->dateCmd));
            $heureDebut = htmlspecialchars(strip_tags($donnesInsert->heure_debut));
            $heureFin = htmlspecialchars(strip_tags($donnesInsert->heure_fin));
            $idPersonne = htmlspecialchars(strip_tags(intval($donnesInsert->id_personne)));
            $numChaise = htmlspecialchars(strip_tags(intval($donnesInsert->numChaise)));

            $req = $query->insertNewReservationEtudiant($dateDebut,$heureDebut,$heureFin 
            ,$idSalle,$idPersonne,$numChaise);
            http_response_code(201);
            return "Insertion success";
        }

        public function verifLoginEtudiant($donnesInsert){
            try{
                $query = new query_data();
                $mail = $donnesInsert->email;
                $mdp = $donnesInsert->mdp;
                $req = $query->verifLoginEtudiant($mail,sha1($mdp));
                if(!empty($req)){
                    http_response_code(200);
                    return "login OK";
                }else{
                    http_response_code(401);
                    return "Login invalid";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function verifLoginProf($donnesInsert){
            try{
                $query = new query_data();
                $mail = $donnesInsert->email;
                $mdp = $donnesInsert->mdp;
                $req = $query->verifLoginProf($mail,sha1($mdp));
                if(!empty($req)){
                    http_response_code(200);
                    return "login OK";
                }else{
                    http_response_code(401);
                    return "Login invalid";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
    
?> 