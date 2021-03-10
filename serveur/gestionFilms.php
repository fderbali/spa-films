<?php
require_once("../includes/films.class.php");
$tabRes = array();
function enregistrer()
{
    $nom = $_POST["nom"];
    $realisateur = $_POST["realisateur"];
    $duree = $_POST["duree"];
    $langue = $_POST["langue"];
    $date = $_POST["date_sortie"];
    $prix = $_POST["prix"];
    $definition = $_POST["definition"];
    $nomPochette = sha1($nom . time());
    $dossierPochettes = "../images/pochettes/";
    $url_bande_annonce = $_POST["url_bande_annonce"];
    $erreur = $message = "";
    try {
        // Enregregistrement des pochettes :
        if ($_FILES['pochette']['tmp_name'] !== "") {
            //Upload de la photo
            $tmp = $_FILES['pochette']['tmp_name'];
            $fichier = $_FILES['pochette']['name'];
            $extension = strrchr($fichier, '.');
            @move_uploaded_file($tmp, $dossierPochettes . $nomPochette . $extension);
            // Enlever le fichier temporaire chargé
            @unlink($tmp); //effacer le fichier temporaire
            $pochette = $nomPochette . $extension;
        }
        $film = new film([
            "id" => (isset($id) ? $id : 0),
            "nom" => $nom,
            "realisateur" => $realisateur,
            "duree" => $duree,
            "langue" => $langue,
            "date" => $date,
            "pochette" => $pochette,
            "url_bande_annonce" => $url_bande_annonce,
            "prix" => $prix,
            "definition" => $definition,
            "en_vedette" => false,
            "score" => 0,
        ]);
        $inserted_id = $film->save();
        if ($inserted_id) {
            $response = [
                "message" => "Film enregistré avec succès !",
                "succes" => true
            ];
        } else {
            $erreur = "Le film n'a pas pu être enregistré !";
            $response = [
                "message" => $erreur = $e->getMessage(),
                "succes" => false
            ];
        }
    } catch (Exception $e) {
        $response = [
            "message" => $erreur = $e->getMessage(),
            "succes" => false
        ];
    } finally {
        print json_encode($response);
        unset($film);
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

function filter()
{
    $film = new film([]);
    try {
        $liste_films = $film->filterFilmListByCategories($_POST["favorite_categ"]);
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
    case "filter":
        filter();
        break;
    case "modifier":
        modifier();
        break;
}
