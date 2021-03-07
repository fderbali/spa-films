<?php
require_once("dfilms.php");
class detail_location extends dfilms
{
    var $id;
    var $id_film;
    var $id_location;
    var $prix;
    var $expire_at;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function save()
    {
        $requete = "INSERT INTO detail_location SET
            id_film = ?,
            id_location = ?,
            prix = ?,
            expire_at = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "iids",
            "vars" => [
                &$this->id_film,
                &$this->id_location,
                &$this->prix,
                &$this->expire_at,
            ],
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }

    public function getNbLocations()
    {
        $requete = "SELECT COUNT(*) nb_locations FROM detail_location";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
}
