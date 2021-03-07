<?php
require_once("../includes/films.class.php");
$tabRes = array();
function enregistrer()
{
    global $tabRes;
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $res = $_POST['res'];
    try {
        $unModele = new filmsModele();
        $pochete = $unModele->verserFichier("pochettes", "pochette", "avatar.jpg", $titre);
        $requete = "INSERT INTO films VALUES(0,?,?,?,?)";
        $unModele = new filmsModele($requete, array($titre, $duree, $res, $pochete));
        $stmt = $unModele->executer();
        $tabRes['action'] = "enregistrer";
        $tabRes['msg'] = "Film bien enregistre";
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function lister()
{
    $film = new film([]);
    try {
        $liste_films = $film->getFilmListWithCategories();
        $films_to_return = [];
        foreach ($liste_films as $film) {
            $film->url_bande_annonce = str_replace("watch?v=", "embed/", $film->url_bande_annonce);
            $films_to_return[] = $film;
        }
        print  json_encode($films_to_return);
    } catch (Exception $e) {
    } finally {
        unset($film);
    }
}

function enlever()
{
    global $tabRes;
    $idf = $_POST['numE'];
    try {
        $requete = "SELECT * FROM films WHERE idf=?";
        $unModele = new filmsModele($requete, array($idf));
        $stmt = $unModele->executer();
        if ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $unModele->enleverFichier("pochettes", $ligne->pochette);
            $requete = "DELETE FROM films WHERE idf=?";
            $unModele = new filmsModele($requete, array($idf));
            $stmt = $unModele->executer();
            $tabRes['action'] = "enlever";
            $tabRes['msg'] = "Film " . $idf . " bien enleve";
        } else {
            $tabRes['action'] = "enlever";
            $tabRes['msg'] = "Film " . $idf . " introuvable";
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function fiche()
{
    global $tabRes;
    $idf = $_POST['numF'];
    $tabRes['action'] = "fiche";
    $requete = "SELECT * FROM films WHERE idf=?";
    try {
        $unModele = new filmsModele($requete, array($idf));
        $stmt = $unModele->executer();
        $tabRes['fiche'] = array();
        if ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['fiche'] = $ligne;
            $tabRes['OK'] = true;
        } else {
            $tabRes['OK'] = false;
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function modifier()
{
    global $tabRes;
    $titre = $_POST['titreF'];
    $duree = $_POST['dureeF'];
    $res = $_POST['resF'];
    $idf = $_POST['idf'];
    try {
        //Recuperer ancienne pochette
        $requette = "SELECT pochette FROM films WHERE idf=?";
        $unModele = new filmsModele($requette, array($idf));
        $stmt = $unModele->executer();
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        $anciennePochette = $ligne->pochette;
        $pochette = $unModele->verserFichier("pochettes", "pochette", $anciennePochette, $titre);

        $requete = "UPDATE films SET titre=?,duree=?, res=?, pochette=? WHERE idf=?";
        $unModele = new filmsModele($requete, array($titre, $duree, $res, $pochette, $idf));
        $stmt = $unModele->executer();
        $tabRes['action'] = "modifier";
        $tabRes['msg'] = "Film $idf bien modifie";
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}
//******************************************************
//Contrôleur
$action = $_POST['action'];
switch ($action) {
    case "enregistrer":
        enregistrer();
        break;
    case "lister":
        lister();
        break;
    case "enlever":
        enlever();
        break;
    case "fiche":
        fiche();
        break;
    case "modifier":
        modifier();
        break;
}
