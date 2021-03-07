<?php
require_once("dfilms.php");
class location extends dfilms
{
    var $id;
    var $id_membre;
    var $created_at;
    var $paiements_id;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function save()
    {
        $requete = "INSERT INTO locations SET
            id_membre = ?,
            created_at = NOW(),
            paiements_id = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "ii",
            "vars" => [
                &$this->id_membre,
                &$this->paiements_id,
            ],
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
}
