<?php
require_once("films.php");
require_once("categories.php");

$film = new film([]);
// Année de sortie
$minMaxAnnee = $film->getMinMaxAnneeSortie();
$minAnneeSortie = $minMaxAnnee[0]->minDateSortie;
$maxAnneeSortie = $minMaxAnnee[0]->maxDateSortie;
// Catégories :
$categorie = new categorie([]);
$categories = $categorie->getCategorieList();
$liste_categories = [];
foreach ($categories as $categorie) {
    $liste_categories[] = $categorie->nom;
}
// Prix 
$minMaxPrix = $film->getMinMaxPrix();
$minPrix = $minMaxPrix[0]->minPrix;
$maxPrix = $minMaxPrix[0]->maxPrix;
// Durée
$minMaxDuree = $film->getMinMaxDuree();
list($heures, $minutes, $secondes) = explode(':', $minMaxDuree[0]->minDuree);
$minDureeBrut = $heures . "h:" . $minutes . "m";
$minDuree = $heures * 60 + $minutes;
list($heures, $minutes, $secondes) = explode(':', $minMaxDuree[0]->maxDuree);
$maxDureeBrut = $heures . "h:" . $minutes . "m";
$maxDuree = $heures * 60 + $minutes;
?>
<!--Année de sortie-->
<strong>Année de sortie : </strong>
<b><?php echo $minAnneeSortie . '&nbsp;-&nbsp;' . $maxAnneeSortie ?></b>&nbsp;&nbsp;
<input id='refine_year' type='text' class='span2' value='' data-slider-min='<?php echo $minAnneeSortie ?>' data-slider-max='<?php echo $maxAnneeSortie ?>' data-slider-step='1' data-slider-value='[<?php echo "$minAnneeSortie,$maxAnneeSortie" ?>]' />
<!--Fin Année de sortie-->
<hr />
<!--Prix-->
<div class="mt-3">
    <strong>Prix en CAD/jour : <?php echo $minPrix . "$ - " . $maxPrix . "$" ?></strong>
    <input id="refine_prix" data-slider-id='ex1Slider' type="text" data-slider-min="<?php echo $minPrix ?>" data-slider-max="<?php echo $maxPrix ?>" data-slider-step="0.1" data-slider-value="<?php echo $maxPrix ?>" />
</div>
<!--Fin Prix-->
<hr />
<!--Score-->
<div class="mt-3">
    <strong>Score TMDB : 0 - 100</strong>
    <input id="refine_score" data-slider-id='refine_score_slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" />
</div>
<!--Fin Score-->
<hr />
<!--Prix-->
<div class="mt-3">
    <strong>Durée : <?php echo $minDureeBrut . " - <span id='labelDureeFilm'>" . $maxDureeBrut ?></span></strong><br />
    <input id="refine_duree" data-slider-id='refine_duree_slider' type="text" data-slider-min="<?php echo $minDuree ?>" data-slider-max="<?php echo $maxDuree ?>" data-slider-step="1" data-slider-value="<?php echo $maxDuree ?>" />
</div>
<!--Fin Prix-->
<hr />
<!-- Catogorie -->
<div class="mt-3">
    <strong>Catégories</strong>
    <?php foreach ($liste_categories as $indice => $categorie) : ?>
        <div class="form-check ml-3">
            <input class="form-check-input refine_categories" checked type="checkbox" value="<?php echo $categorie ?>" id="ctegorie<?php echo $indice ?>" />
            <label class="form-check-label" for="ctegorie<?php echo $indice ?>">
                <?php echo $categorie ?>
            </label>
        </div>
    <?php endforeach; ?>

</div>
<br />
<div class="form-check ml-3">
    <input class="form-check-input" checked type="checkbox" id="checkAll">
    <label class="form-check-label" for="checkAll">
        Sélectionner / Déselectionner tout
    </label>
</div>
<!-- Fin Catogorie -->