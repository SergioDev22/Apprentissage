<?php

require_once("Model/modelWebAdmin.php");
class Traitement{

    public function setDateNameFrench($date){
        setlocale(LC_ALL, 'fr_FR');
        return strftime('%A', strtotime($date));
    }

    public function statSalleDay($date,$idTypeSalle){
        try{
            $query = new query_data();
            $req = $query->statSalleDayNameAndCount($date,$idTypeSalle);
            $data = $req->fetchAll();
            $dataStat["statSalleDay"] = [];
            foreach($data as $value){
                $nameDayFrench = $this->setDateNameFrench($date);
                $req1 = $query->statSallDayProprety($date,$idTypeSalle,$value["nomSalle"]);
                $data1 = $req1->fetchAll();
                $statSallDayProprety = [];
                foreach($data1 as $valeur){
                    $statSallDayProprety[]=[
                        "heureDebut" => $valeur["heure_debut"],
                        "heureFin" => $valeur["heure_fin"],
                        "nom"=>$valeur["nom"],
                        "prenom"=>$valeur["prenom"]
                    ];
                }
                $dataStat["statSalleDay"][] = [
                    "nomSalle"=>$value["nomSalle"],
                    "nomDuJour"=>$nameDayFrench,
                    "nombreDeReservation"=>$value["nombreDeReservation"],
                    "propriete"=>$statSallDayProprety

                ];
            }
            return json_encode($dataStat,JSON_PRETTY_PRINT);    
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    

    public function statSalleDayEtudiat($date)
    {
        try{
            $query = new query_data();
            $req = $query->statSalleDayEtudiantNameAndCount($date);
            $data = $req->fetchAll();
            $dataStat["statSalleDay"] = [];
            foreach($data as $value){
                $nameDayFrench = $this->setDateNameFrench($date);
                $req1 = $query->statSalleDayEtudiantPropriety($date,$value["nomSalle"]);
                $data1 = $req1->fetchAll();
                $statSallDayProprety = [];
                foreach($data1 as $valeur){
                    $statSallDayProprety[]=[
                        "heureDebut" => $valeur["heure_debut"],
                        "heureFin" => $valeur["heure_fin"],
                        "numChaise"=>$valeur["numChaise"],
                        "nom"=>$valeur["nom"],
                        "prenom"=>$valeur["prenom"]
                    ];
                }
                $dataStat["statSalleDay"][] = [
                    "nomSalle"=>$value["nomSalle"],
                    "nomDuJour"=>$nameDayFrench,
                    "nombre des personnes assistés"=>$value["nombreDeReservation"],
                    "propriete"=>$statSallDayProprety

                ];
            }
            return json_encode($dataStat,JSON_PRETTY_PRINT);    
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    

    public function statSalleWeek($date,$idTypeSalle){
        try{
            $query = new query_data();
            $req1 = $query->statSalleWeekNameAndCount($date,$idTypeSalle);
            $data1 = $req1->fetchAll();
            
            $dataStat["statSalleWeek"] = [];
            foreach($data1 as $value){
                $dataStatDate = [];
                $req2 = $query->statSalleWeekAllDate($date,$idTypeSalle,$value["nomSalle"]);
                $data2 = $req2->fetchAll();

                foreach($data2 as $valeur){
                    $dataStatPropriety = [];
                    $req3 = $query->statSalleWeekPropriety($date,$idTypeSalle,
                    $value["nomSalle"],$valeur["dateCmd"]);
                    $data3 = $req3->fetchAll();

                    foreach($data3 as $val){
                        $dataStatPropriety[] = [
                            "heureDebut"=>$val["heure_debut"],
                            "heureFin"=>$val["heure_fin"],
                            "nom" => $val["nom"],
                            "prenom"=>$val["prenom"]
                        ];
                    }

                    $nameDayFrench = $this->setDateNameFrench($valeur["nomDuJour"]);
                    $dataStatDate[] = [
                        "date" => $valeur["dateCmd"],
                        "nomDuJOur"=>$nameDayFrench,
                        "propriété"=> $dataStatPropriety
                    ];
                }

                $dataStat["statSalleWeek"][] = [
                    "nomSalle"=>$value["nomSalle"],
                    "nombre"=>$value["nombre"],
                    "Toutes les date de la semaine"=>$dataStatDate
                ];
            }
            return json_encode($dataStat,JSON_PRETTY_PRINT);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }


    public function statSalleWeekEtudiant($date,$idTypeSalle=1){
        try{
            $query = new query_data();
            $req1 = $query->statSalleWeekNameAndCount($date,$idTypeSalle);
            $data1 = $req1->fetchAll();
            
            $dataStat["statSalleWeek"] = [];
            foreach($data1 as $value){
                $dataStatDate = [];
                $req2 = $query->statSalleWeekAllDate($date,$idTypeSalle,$value["nomSalle"]);
                $data2 = $req2->fetchAll();

                foreach($data2 as $valeur){
                    $dataStatPropriety = [];
                    $req3 = $query->statSalleWeekProprietyEtudiant($date,$idTypeSalle,
                    $value["nomSalle"],$valeur["dateCmd"]);
                    $data3 = $req3->fetchAll();

                    foreach($data3 as $val){
                        $dataStatPropriety[] = [
                            "heureDebut"=>$val["heure_debut"],
                            "heureFin"=>$val["heure_fin"],
                            "nom" => $val["nom"],
                            "prenom"=>$val["prenom"],
                            "numChaise"=>$val["numChaise"]
                        ];
                    }

                    $nameDayFrench = $this->setDateNameFrench($valeur["nomDuJour"]);
                    $dataStatDate[] = [
                        "date" => $valeur["dateCmd"],
                        "nomDuJOur"=>$nameDayFrench,
                        "propriété"=> $dataStatPropriety
                    ];
                }

                $dataStat["statSalleWeek"][] = [
                    "nomSalle"=>$value["nomSalle"],
                    "nombre de personne assisté"=>$value["nombre"],
                    "Toutes les date de la semaine"=>$dataStatDate
                ];
            }
            return json_encode($dataStat,JSON_PRETTY_PRINT);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function statSalleMonth($month,$id_type_salle){
        try{
            $query = new query_data();
            $req = $query->statSalleMonth($month,$id_type_salle);
            $data = $req->fetchAll();


            $dataStat["statSalleMonth"] = [];
            foreach($data as $value){
                $dataStat["statSalleMonth"][] = [
                    "nomSalle"=>$value["nomSalle"],
                    "nombre"=>$value["nombre"]
                ];
            }
            return json_encode($dataStat,JSON_PRETTY_PRINT);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function verifLoginAdmin($donnesInsert){
        try{
            $query = new query_data();
            $mail = $donnesInsert->email;
            $mdp = $donnesInsert->mdp;
            $req = $query->verifLoginAdmin($mail,sha1($mdp));
            if(!empty($req)){
                http_response_code(200);
                return "login OK";
            }else{
                http_response_code(404);
                return "Login invalid";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
  
}

?>