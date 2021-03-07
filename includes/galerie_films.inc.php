<?php
require_once("films.php");
$film = new film([]);
if (isset($limited_gallery)) {
    $films = $film->getFilmListWithCategories($limited_gallery);
}
$template_film = "";
foreach ($films as $film) :
    $dateTime = new DateTime($film->duree);
    $duree = $dateTime->format("H\h:i\m");
    $cetegories = explode(',', $film->categories);
    $template_categories = '';
    foreach ($cetegories as $categ) {
        $template_categories .= '<span class="badge badge-primary">' . $categ . '</span> ';
    }
    $score = ceil(($film->score * 88) / 100);
?>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
        <div class="video-thumb light">
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
            <div class="video-content"> <small class="range"><?php echo $duree ?></small>
                <h3 class="name"><?php echo $film->nom ?></h3>
                <ul class="tags">
                    <li><?php echo $template_categories; ?></li>
                </ul>
                <!-- end age -->
            </div>
            <div>
                <h5><a href="pages/bande_annonce.php?id=<?php echo $film->id ?>"><span class="badge badge-secondary btn-block">Bande annonce <i class="lni lni-play"></i></span></a></h5>
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