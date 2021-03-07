<?php
require_once("dfilms.php");
class newsletter extends dfilms{
    var $id;
    var $courriel;
    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function getNewsletterList(){
        $requete="SELECT * FROM newsletter";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function save(){
        $requete="INSERT INTO newsletter 
        SET id = ?,
        courriel = ?
        ON DUPLICATE KEY 
        UPDATE courriel = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "iss",
            "vars" => [
                &$this->id,
                &$this->courriel,
                &$this->courriel
            ]
        ];
        $result = $this->sqlDoQuery($options);
        if($result->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function delete(){
        $requete="DELETE FROM newsletter WHERE id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $result = $this->sqlDoQuery($options);
        if($result->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function loadFromBd(){
        $requete="SELECT * FROM newsletter WHERE id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $results = $this->sqlDoQuery($options);
        $this->courriel = $results[0]->courriel;
    }
}