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
    public function getAllSalle()
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT id_salle,nomSalle,capacite,prise,
                    photoDeCouverture,nom_type 
                    FROM salle
                    INNER JOIN types_salle
                    ON salle.id_type_salle = types_salle.id_type_salle
                ';

            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSalleReserveProf()
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle,capacite,photoDeCouverture,
                    heure_debut,heure_fin,nom,prenom
                    FROM salle 
                    INNER JOIN reservation 
                    ON salle.id_salle = reservation.id_salle
                    INNER JOIN personne 
                    ON reservation.id_personne = personne.id_personne
                    WHERE dateCmd = DATE(NOW()) 
                    AND types = "PROFESSEUR"
                    AND confirmation = "OUI"
                ';

            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSalleReserveEtudiant()
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle,capacite,photoDeCouverture,
                        heure_debut,heure_fin,nom,prenom,NumChaise
                        FROM salle 
                        INNER JOIN reservation 
                        ON salle.id_salle = reservation.id_salle
                        INNER JOIN personne 
                        ON reservation.id_personne = personne.id_personne
                        WHERE dateCmd = DATE(NOW()) 
                        AND types = "ETUDIANT"
                        AND confirmation = "OUI"
                    ';

            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSalleReserveAutre()
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT nomSalle,capacite,photoDeCouverture,
                    heure_debut,heure_fin,nom,prenom,organisation
                    FROM salle 
                    INNER JOIN reservation 
                    ON salle.id_salle = reservation.id_salle
                    INNER JOIN personne 
                    ON reservation.id_personne = personne.id_personne
                    WHERE dateCmd = DATE(NOW()) 
                    AND types = "AUTRE"
                    AND confirmation = "OUI"
                ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSalleProfDispo()
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT id_salle,nomSalle,capacite,
                        photoDeCouverture
                        FROM types_salle
                        INNER JOIN salle
                        ON types_salle.id_type_salle = salle.id_type_salle
                        WHERE id_salle NOT IN 
                        (SELECT id_salle 
                        FROM reservation
                        WHERE dateCmd = DATE(NOW()) 
                        )
                        AND salle.id_type_salle=2
                    ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSalleAutreDispo()
    {
        try {
            $bdd = $this->dbconnect();
            $req = 'SELECT id_salle,nomSalle,capacite,
                        photoDeCouverture
                        FROM types_salle
                        INNER JOIN salle
                        ON types_salle.id_type_salle = salle.id_type_salle
                        WHERE id_salle NOT IN 
                        (SELECT id_salle 
                        FROM reservation
                        WHERE dateCmd = DATE(NOW()) 
                        )
                        AND salle.id_type_salle=3
                    ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getMateriel($id_salle)
    {
        try {
            $bdd = $this->dbconnect();
            $req =
                'SELECT * FROM materiel 
                        WHERE id_salle = ' .
                $id_salle .
                '
                ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insertNewReservation(
        $dateDebut,
        $heureDebut,
        $heureFin,
        $idSalle,
        $idPersonne
    ) {
        try {
            $bdd = $this->dbconnect();
            $req =
                'INSERT INTO reservation (date_reservation,dateCmd,heure_debut,heure_fin,
                        id_salle,id_personne)
                        VALUES (NOW(), "' .
                $dateDebut .
                '", "' .
                $heureDebut .
                '", 
                     "' .
                $heureFin .
                '",
                        "' .
                $idSalle .
                '", "' .
                $idPersonne .
                '")
                        ';
            $result = $bdd->prepare($req);
            $result->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insertNewReservationEtudiant(
        $dateDebut,
        $heureDebut,
        $heureFin,
        $idSalle,
        $idPersonne,
        $numChaise
    ) {
        try {
            $bdd = $this->dbconnect();
            $req =
                'INSERT INTO reservation (date_reservation,dateCmd,heure_debut,heure_fin,
                        id_salle,id_personne,numChaise)
                        VALUES (NOW(), "' .
                $dateDebut .
                '", "' .
                $heureDebut .
                '", 
                     "' .
                $heureFin .
                '",
                        "' .
                $idSalle .
                '", "' .
                $idPersonne .
                '", "' .
                $numChaise .
                '")
                        ';
            $result = $bdd->prepare($req);
            $result->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function verifLoginEtudiant($mail, $mdp)
    {
        try {
            $bdd = $this->dbconnect();
            $req =
                ' SELECT 1 FROM `personne` WHERE mail = "' .
                $mail .
                '" AND mdp = "' .
                $mdp .
                '" AND types = "ETUDIANT"';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function verifLoginProf($mail, $mdp)
    {
        try {
            $bdd = $this->dbconnect();
            $req =
                ' SELECT 1 FROM personne WHERE mail = "' .
                $mail .
                '" AND mdp = "' .
                $mdp .
                '" AND types = "PROFESSEUR" ';
            $result = $bdd->prepare($req);
            $result->execute();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
