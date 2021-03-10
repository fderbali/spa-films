<?php
require_once("dfilms.php");
class film extends dfilms
{
    var $id;
    var $nom;
    var $realisateur;
    var $duree;
    var $langue;
    var $date;
    var $pochette;
    var $en_vedette;
    var $pochette_grand_format;
    var $url_bande_annonce;
    var $prix;
    var $score;
    var $definition;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function getFilmList($limit = null)
    {
        if ($limit) {
            $requete = "SELECT * FROM films ORDER BY id desc LIMIT ?";
            $options = [
                "requete" => $requete,
                "types" => "i",
                "vars" => [&$limit]
            ];
        } else {
            $requete = "SELECT * FROM films";
            $options = [
                "requete" => $requete,
                "types" => "",
                "vars" => []
            ];
        }
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function getFilmListWithCategories($limit = null)
    {
        if ($limit) {
            $requete = "SELECT  
                        films.id, 
                        films.nom, 
                        films.realisateur, 
                        films.duree, 
                        films.langue, 
                        films.date, 
                        films.pochette, 
                        films.en_vedette, 
                        films.pochette_grand_format, 
                        films.url_bande_annonce, 
                        films.prix, 
                        films.score,
                        films.definition,
                        group_concat(categories.nom) categories
                FROM     films 
                LEFT JOIN     film_categorie 
                ON       films.id = film_categorie.films_id 
                LEFT JOIN     categories 
                ON       film_categorie.categorie_id = categories.id 
                GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13 limit ?";
            $options = [
                "requete" => $requete,
                "types" => "i",
                "vars" => [&$limit]
            ];
        } else {
            $requete = "SELECT   
                        films.id,
                        films.nom, 
                        films.realisateur, 
                        films.duree, 
                        films.langue, 
                        films.date, 
                        films.pochette, 
                        films.en_vedette, 
                        films.pochette_grand_format, 
                        films.url_bande_annonce, 
                        films.prix, 
                        films.score,
                        films.definition,
                        group_concat(categories.nom) categories
                FROM     films 
                LEFT JOIN     film_categorie 
                ON       films.id = film_categorie.films_id 
                LEFT JOIN     categories 
                ON       film_categorie.categorie_id = categories.id 
                GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13";
            $options = [
                "requete" => $requete,
                "types" => "",
                "vars" => []
            ];
        }
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function filterFilmListByCategories($favourite_categs)
    {
        //$favourite_categs = implode(",", $favourite_categs);
        $requete = "SELECT  
                        films.id, 
                        films.nom, 
                        films.realisateur, 
                        films.duree, 
                        films.langue, 
                        films.date, 
                        films.pochette, 
                        films.en_vedette, 
                        films.pochette_grand_format, 
                        films.url_bande_annonce, 
                        films.prix, 
                        films.score,
                        films.definition,
                        group_concat(categories.nom) categories
                FROM     films 
                JOIN     film_categorie 
                ON       films.id = film_categorie.films_id 
                JOIN     categories 
                ON       film_categorie.categorie_id = categories.id 
                GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13";
        $having = [];
        foreach ($favourite_categs  as $favourite_categ) {
            $having[] = " categories like '%$favourite_categ%' ";
        }
        $requete .= " HAVING " . implode(" AND ", $having);
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $results = $this->sqlDoQuery($options);
        return $results;
    }

    public function save()
    {
        $requete = "INSERT INTO films 
        SET id = ?,
        nom = ?,
        realisateur = ?,
        duree = ?,
        langue = ?,
        date = ?,
        pochette = ?,
        en_vedette = ?,
        pochette_grand_format = ?,
        url_bande_annonce = ?,
        prix = ?,
        score = ?,
        definition =?

        ON DUPLICATE KEY 

        UPDATE nom = ?,
        realisateur = ?,
        duree = ?,
        langue = ?,
        date = ?,
        pochette = ?,
        en_vedette = ?,
        pochette_grand_format = ?,
        url_bande_annonce = ?,
        prix = ?,
        score = ?,
        definition = ?
        ";
        $options = [
            "requete" => $requete,
            "types" => "issssssissdisssssssissdis",
            "vars" => [
                &$this->id,
                &$this->nom,
                &$this->realisateur,
                &$this->duree,
                &$this->langue,
                &$this->date,
                &$this->pochette,
                &$this->en_vedette,
                &$this->pochette_grand_format,
                &$this->url_bande_annonce,
                &$this->prix,
                &$this->score,
                &$this->definition,
                &$this->nom,
                &$this->realisateur,
                &$this->duree,
                &$this->langue,
                &$this->date,
                &$this->pochette,
                &$this->en_vedette,
                &$this->pochette_grand_format,
                &$this->url_bande_annonce,
                &$this->prix,
                &$this->score,
                &$this->definition
            ]
        ];
        $result = $this->sqlDoQuery($options);
        if ($result->affected_rows > 0) {
            return $result->insert_id;
        }
        return false;
    }

    public function delete()
    {
        $requete = "DELETE FROM films WHERE id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $result = $this->sqlDoQuery($options);
        if ($result->affected_rows > 0) {
            return true;
        }
        return false;
    }

    public function loadFromBd()
    {
        $requete = "SELECT * FROM films WHERE id= ?";
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

    public function load_categories()
    {
        $requete = "SELECT * FROM film_categorie WHERE films_id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $results = $this->sqlDoQuery($options);
        $categories = [];
        foreach ($results as $result) {
            $categories[] = $result->categorie_id;
        }
        return $categories;
    }

    public function save_categories($categories)
    {
        foreach ($categories as $categorie) {
            $requete = "INSERT INTO film_categorie SET films_id = ?, categorie_id = ?";
            $options = [
                "requete" => $requete,
                "types" => "ii",
                "vars" => [&$this->id, &$categorie]
            ];
            $result = $this->sqlDoQuery($options);
        }
        return true;
    }

    public function delete_categories()
    {
        $requete = "DELETE FROM film_categorie WHERE films_id = ?";
        $options = [
            "requete" => $requete,
            "types" => "i",
            "vars" => [&$this->id]
        ];
        $result = $this->sqlDoQuery($options);
        return true;
    }
    public function getMinMaxAnneeSortie()
    {
        $requete = "SELECT MIN(YEAR(date)) AS minDateSortie, MAX(YEAR(date)) AS maxDateSortie FROM films";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
    public function getMinMaxPrix()
    {
        $requete = "SELECT MIN(prix) AS minPrix, MAX(prix) AS maxPrix FROM films";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
    public function getMinMaxDuree()
    {
        $requete = "SELECT MIN(duree) AS minDuree, MAX(duree) AS maxDuree FROM films";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
    public function getNbFilms()
    {
        $requete = "SELECT COUNT(*) nb_films FROM films";
        $options = [
            "requete" => $requete,
            "types" => "",
            "vars" => []
        ];
        $result = $this->sqlDoQuery($options);
        return $result;
    }
}
