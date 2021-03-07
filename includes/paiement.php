<?php
require_once("dfilms.php");
class paiement extends dfilms
{
    var $id;
    var $id_membre;
    var $created_at;
    var $montant;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function save()
    {
        $requete = "INSERT INTO paiements SET
            id_membre = ?,
            created_at = NOW(),
            montant = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "id",
            "vars" => [
                &$this->id_membre,
                &$this->montant,
            ],
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }

    public function getProfit()
    {
        $requete = "SELECT SUM(montant) as profit FROM paiements";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => [],
        ];
        return $this->sqlDoQuery($options);
    }
}
