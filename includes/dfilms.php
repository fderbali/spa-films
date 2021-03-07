<?php
class dfilms
{
    var $connexion;
    protected function __construct($options)
    {
        require_once(__DIR__ . "/../bd/connexion.inc.php");
        $connexion = new mysqli(SERVEUR, USAGER, PASSE, BD);
        if ($connexion->connect_errno) {
            throw new Exception("Probleme de connexion au serveur de bd");
        }
        $this->connexion = $connexion;
        foreach ($options as $key => $value) {
            if (array_key_exists($key, get_object_vars($this))) {
                $this->{$key} = $value;
            }
        }
    }

    protected function sqlDoQuery($options)
    {
        $stmt = $this->connexion->prepare($options["requete"]);
        if (count($options["vars"]) > 0) {
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($options["types"]), $options["vars"]));
        }
        if (!$stmt->execute()) {
            throw new Exception($stmt->errno . " " . $stmt->error);
        }
        $result = $stmt->get_result();
        if (is_bool($result)) {
            return ($stmt);
        } else {
            $lignes = [];
            while ($row = $result->fetch_object()) {
                $lignes[] = $row;
            }
            return $lignes;
        }
    }
}
