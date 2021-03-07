<?php
require_once("dfilms.php");
class categorie extends dfilms{
    var $id;
    var $nom;
    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function getCategorieList(){
        $requete="SELECT * FROM categories";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function save(){
        $requete="INSERT INTO categories 
        SET id = ?,
        nom = ?

        ON DUPLICATE KEY 

        UPDATE nom = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "iss",
            "vars" => [
                &$this->id,
                &$this->nom,
                &$this->nom
            ]
        ];
        $result = $this->sqlDoQuery($options);
        if($result->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function delete(){
        $requete="DELETE FROM categories WHERE id = ?";
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
        $requete="SELECT * FROM categories WHERE id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $results = $this->sqlDoQuery($options);
        $this->nom = $results[0]->nom;
    }
}