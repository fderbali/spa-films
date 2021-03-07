<?php
require_once("dfilms.php");
class membre extends dfilms
{
    var $id;
    var $courriel;
    var $nom;
    var $prenom;
    var $sexe;
    var $date_de_naissance;
    var $password;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function authenticate()
    {
        $requete = "SELECT * FROM connexions WHERE courriel= ? AND mot_de_passe = password(?) AND status = 'A'";
        $options = [
            "requete" => $requete,
            "types" => "ss",
            "vars" => [&$this->courriel, &$this->password]
        ];
        $results = $this->sqlDoQuery($options);
        if (count($results) == 1) {
            return $results[0];
        }
        return false;
    }

    public function register($admin = false)
    {
        $requete = "INSERT INTO membres SET
            id = ?,
            nom = ?,
            prenom = ?,
            courriel = ?,
            sexe = ?,
            date_de_naissance = ?

            ON DUPLICATE KEY 

            UPDATE nom = ?,
            prenom = ?,
            courriel= ?,
            sexe = ?,
            date_de_naissance = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "issssssssss",
            "vars" => [
                &$this->id,
                &$this->nom,
                &$this->prenom,
                &$this->courriel,
                &$this->sexe,
                &$this->date_de_naissance,
                &$this->nom,
                &$this->prenom,
                &$this->courriel,
                &$this->sexe,
                &$this->date_de_naissance
            ],
        ];
        $result = $this->sqlDoQuery($options);
        if ($result->affected_rows) {
            $requete = "INSERT INTO connexions SET
                courriel = ?,
                mot_de_passe = PASSWORD(?),
                status = 'A',
                date_derniere_connexion = NOW()" . ($admin ? ",is_admin = 'Y'" : " ")
                . "ON DUPLICATE KEY
                UPDATE mot_de_passe = PASSWORD(?),
                status='A',
                date_derniere_connexion = NOW()" . ($admin ? ",is_admin = 'Y'" : "");
            $options = [
                "requete" => $requete,
                "types" => "sss",
                "vars" => [&$this->courriel, &$this->password, &$this->password],
            ];
            $result = $this->sqlDoQuery($options);
            return $result;
        };
        return true;
    }

    public function checkCourriel()
    {
        $requete = "SELECT * FROM connexions WHERE courriel= ?";
        $options = [
            "requete" => $requete,
            "types" => "s",
            "vars" => [&$this->courriel]
        ];
        $results = $this->sqlDoQuery($options);
        if (count($results) == 1) {
            return true;
        }
        return false;
    }

    public function getMembresList()
    {
        $requete = "SELECT * FROM connexions JOIN membres ON connexions.courriel = membres.courriel WHERE connexions.is_admin = 'N'";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function getAdminList()
    {
        $requete = "SELECT * FROM connexions JOIN membres ON connexions.courriel = membres.courriel WHERE connexions.is_admin = 'Y'";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function register_to_newsletter()
    {
        $requete = "INSERT INTO newsletter SET courriel = ?";
        $options = [
            "requete" => $requete,
            "types" => "s",
            "vars" => [$this->courriel]
        ];
        return $this->sqlDoQuery($options);
    }

    public function loadFromBd()
    {
        $requete = "SELECT * FROM membres WHERE courriel = ? ";

        $options = [
            "requete" => $requete,
            "types" => "s",
            "vars" => [&$this->courriel]
        ];
        $results = $this->sqlDoQuery($options);
        $result = $results[0];
        foreach ($result as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function loadFromBdById()
    {
        $requete = "SELECT * FROM membres WHERE id = ? ";

        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $results = $this->sqlDoQuery($options);
        $result = $results[0];
        foreach ($result as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function delete()
    {
        $requete = "DELETE FROM membres WHERE id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $result = $this->sqlDoQuery($options);
        if ($result->affected_rows > 0) {
            $requete = "DELETE FROM connexions WHERE courriel = ?";
            $options = [
                "requete" => $requete,
                "types" => "s",
                "vars" => [&$this->courriel]
            ];
            $result = $this->sqlDoQuery($options);
            if ($result->affected_rows > 0) {
                return true;
            }
        }
        return false;
    }

    public function getLocations()
    {
        $requete = "SELECT id_film, expire_at
        FROM detail_location 
        JOIN locations ON detail_location.id_location = locations.id
        WHERE locations.id_membre = ? AND expire_at > now()";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
    public function getNbMembre()
    {
        $requete = "SELECT COUNT(*) nb_membres FROM membres JOIN connexions ON membres.courriel = connexions.courriel WHERE is_admin = 'N'";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
}
