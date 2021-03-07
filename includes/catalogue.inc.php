<?php
require_once("films.php");
$film = new film([]);
$films = $film->getFilmListWithCategories();
$template_film = "";
foreach ($films as $film) :
    $dateTime = new DateTime($film->duree);
    $duree = $dateTime->format("H\h:i\m");
    $duree_in_minutes = $dateTime->format("i") + $dateTime->format("H") * 60;

    $cetegories = explode(',', $film->categories);
    $template_categories = '';
    foreach ($cetegories as $categ) {
        $template_categories .= '<span class="badge badge-primary">' . $categ . '</span> ';
    }
    $score = ceil(($film->score * 88) / 100);
    $dateTime = new DateTime($film->date);
    $annee_sortie = $dateTime->format("Y");
?>
    <div class="col-3 film" data-annee="<?php echo $annee_sortie ?>" data-prix="<?php echo $film->prix ?>" data-score="<?php echo $film->score ?>" data-duree="<?php echo $duree_in_minutes ?>" data-categories="<?php echo $film->categories; ?>">
        <div class="video-thumb">
            <figure class="video-image"><img src="assets/images/pochettes/<?php echo $film->pochette ?>" class="img-thumbnail" alt="Image">
                <div class="circle-rate">
                    <svg class="circle-chart" viewBox="0 0 30 30" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                        <circle class="circle-chart__background" stroke="#2f3439" stroke-width="2" fill="none" cx="15" cy="15" r="14"></circle>
                        <circle class="circle-chart__circle" stroke="#4eb04b" stroke-width="2" stroke-dasharray="<?php echo $score ?>,100" cx="15" cy="15" r="14"></circle>
                    </svg>
                    <b><?php echo $film->score ?>%</b>
                </div>
                <!-- end circle-rate -->
                <div class="hd"><?php echo $film->definition ?> <b>HD</b></div>
                <!-- end hd -->
            </figure>
            <div class="video-content alert alert-primary"> <small class="range"><i class="far fa-clock"></i>&nbsp;<?php echo $duree ?> <i class="far fa-calendar-alt"></i> <?php echo $annee_sortie ?></small>
                <h3 class="name"><i class="fas fa-film"></i>&nbsp;<?php echo $film->nom ?></h3>
                <i class="fas fa-grip-horizontal"></i>&nbsp;&nbsp;
                <ul class="tags">
                    <li><?php echo $template_categories; ?></li>
                </ul>
                <!-- end age -->

                <h5><a href="pages/bande_annonce.php?id=<?php echo $film->id ?>"><span class="badge badge-danger btn-block">Bande annonce <i class="far fa-play-circle"></i></span></a></h5>
                <h3 class="name">
                    <i class="fas fa-dollar-sign"></i> <?php echo $film->prix ?>
                    <a class="btn btn-primary" href="pages/panier.php?id=<?php echo $film->id ?>"><i class="fas fa-cart-arrow-down"></i>&nbsp;Louer</a>
                </h3>
            </div>
            <!-- end video-content -->
        </div>
        <!-- end video-thumb -->
    </div>
    <!-- end col-2 -->
<?php
endforeach;
?>