<?php
class connect_bdd
{
    protected function dbconnect()
    {
        try {
            $connexion = new PDO(
                'mysql:host= ;dbname= ',
                '',
                ''
            );
            return $connexion;
        } catch (PDOException $erreurs) {
            die($erreurs->getMessage());
        }
    }
}

class query_data extends connect_bdd
{
    public function statSalleDayNameAndCount($date, $idTypeSalle)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle, COUNT(dateCmd) AS nombreDeReservation,
                DAYNAME(dateCmd) AS nomDuJour
                FROM salle 
                INNER JOIN reservation
                ON salle.id_salle = reservation.id_salle
                WHERE dateCmd = "' . $date . '" 
                AND id_type_salle = "' . $idTypeSalle . '"
                GROUP BY nomSalle
        ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSallDayProprety($date, $idTypeSalle, $nomSalle)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT heure_debut,heure_fin,nom,prenom
                FROM salle 
                INNER JOIN reservation
                ON salle.id_salle = reservation.id_salle
                INNER JOIN personne
                ON reservation.id_personne = personne.id_personne
                WHERE dateCmd = "' . $date . '" AND id_type_salle = "' . $idTypeSalle . '"
                AND nomSalle = "' . $nomSalle . '"
         ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSalleDayEtudiantNameAndCount($date)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle, COUNT(dateCmd) AS nombreDeReservation
                ,DAYNAME(dateCmd) AS nomDuJour
                FROM salle 
                INNER JOIN reservation
                ON salle.id_salle = reservation.id_salle
                WHERE dateCmd = "' . $date . '" AND id_type_salle = 1
                GROUP BY nomSalle
            ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSalleDayEtudiantPropriety($date, $nomSalle)
    {
        $bdd = $this->dbconnect();
        $req = 'SELECT numChaise,heure_debut,heure_fin,nom,prenom
                FROM salle 
                INNER JOIN reservation
                ON salle.id_salle = reservation.id_salle
                INNER JOIN personne
                ON reservation.id_personne = personne.id_personne
                WHERE dateCmd = "' . $date . '" AND id_type_salle = 1
                AND nomSalle = "' . $nomSalle . '"
        ';
        $result = $bdd->prepare($req);
        $result->execute();
        return $result;
    }

    public function statSalleWeekNameAndCount($date, $idTypeSalle)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle,COUNT(nomSalle) AS nombre
                    FROM salle 
                    INNER JOIN reservation 
                    ON salle.id_salle = reservation.id_salle
                    WHERE dateCmd BETWEEN DATE_SUB("' . $date . '", INTERVAL 1 WEEK)
                    AND "' . $date . '" AND id_type_salle = "' . $idTypeSalle . '"
                    GROUP BY nomSalle
                    ORDER BY nomSalle ASC
            ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSalleWeekAllDate($date, $idTypeSalle, $nomSalle)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT dateCmd,DAYNAME(dateCmd) AS nomDuJour
                FROM reservation 
                INNER JOIN salle 
                ON reservation.id_salle = salle.id_salle
                WHERE dateCmd BETWEEN DATE_SUB("' . $date . '", INTERVAL 1 WEEK)
                AND "' . $date . '" AND id_type_salle = "' . $idTypeSalle . '"
                AND nomSalle = "' . $nomSalle . '"
                GROUP BY dateCmd
            ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSalleWeekPropriety($date, $idTypeSalle, $nomSalle, $dateSpec)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT heure_debut,heure_fin,nom,prenom
                    FROM reservation 
                    INNER JOIN salle 
                    ON reservation.id_salle = salle.id_salle
                    INNER JOIN personne
                    ON reservation.id_personne = personne.id_personne
                    WHERE dateCmd BETWEEN DATE_SUB("' . $date . '", INTERVAL 1 WEEK) 
                    AND "' . $date . '" 
                    AND id_type_salle = "' . $idTypeSalle . '" 
                    AND nomSalle = "' . $nomSalle . '"
                    AND dateCmd = "' . $dateSpec . '"
            ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSalleWeekProprietyEtudiant($date, $idTypeSalle, $nomSalle, $dateSpec)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT heure_debut,heure_fin,nom,prenom,numChaise
                    FROM reservation 
                    INNER JOIN salle 
                    ON reservation.id_salle = salle.id_salle
                    INNER JOIN personne
                    ON reservation.id_personne = personne.id_personne
                    WHERE dateCmd BETWEEN DATE_SUB("' . $date . '", INTERVAL 1 WEEK) 
                    AND "' . $date . '" 
                    AND id_type_salle = "' . $idTypeSalle . '" 
                    AND nomSalle = "' . $nomSalle . '"
                    AND dateCmd = "' . $dateSpec . '"
            ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function statSalleMonth($month, $id_type_salle)
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle,Count(dateCmd) AS nombre 
                    FROM salle 
                    INNER JOIN reservation
                    ON salle.id_salle = reservation.id_salle
                    WHERE MONTH(dateCmd) = "' . $month . '" 
                    AND id_type_salle = "' . $id_type_salle . '"
                    GROUP BY nomSalle
            ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function verifLoginAdmin($mail, $mdp)
    {
        try {
            $bdd = $this->dbconnect();
            $req =
                ' SELECT 1 FROM personne WHERE mail = "' .
                $mail .
                '" AND mdp = "' .
                $mdp .
                '" AND types = "ADMIN" ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
