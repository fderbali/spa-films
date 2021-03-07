<?php
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $nb_jours = $_POST["nb_jours"];
    if ($nb_jours > 0) {
        $_SESSION['PANIER'][$id] = "$nb_jours";
    } else {
        unset($_SESSION['PANIER'][$id]);
    }
}
$films_in_panier = [];
$total_hors_taxes = 0;

if (isset($_SESSION['PANIER'])) {
    if (count($_SESSION['PANIER'])) {
        foreach ($_SESSION['PANIER'] as $id => $nb_jours) {
            $film = new film(["id" => $id]);
            $film->loadFromBd();
            $total_hors_taxes += $nb_jours * $film->prix;
            $films_in_panier[] = $film;
        }
    }
}
if (isset($message)) : ?>
    <div class='jumbotron'>
        <div class='d-flex justify-content-center'>
            <div class="card" style="width: 10rem;">
                <img class="card-img-top" src="assets/images/pochettes/<?php echo $film->pochette ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $film->nom ?></h5>
                </div>
            </div>
        </div>
        <div class="alert alert-success text-center mt-2">
            <p><?php echo $message ?></p>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <a href="pages/catalogue.php" class="btn btn-primary btn-block">Continuer à magasiner&nbsp;&nbsp;<i class="fas fa-book-open"></i></a>
            </div>
            <div class="col-6">
                <a href="pages/panier.php" class="btn btn-success btn-block">Voir votre panier&nbsp;<i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
    </div>
    <?php else :
    echo '<div class="row" id="panier">';
    foreach ($films_in_panier as $film) :
        $dateTime = new DateTime($film->duree);
        $duree = $dateTime->format("H\h:i\m");
        $duree_in_minutes = $dateTime->format("i") + $dateTime->format("H") * 60;
        $score = ceil(($film->score * 88) / 100);
        $dateTime = new DateTime($film->date);
        $annee_sortie = $dateTime->format("Y");
    ?>
        <div class="col-3 film">
            <div class="video-thumb">
                <figure class="video-image"><img src="assets/images/pochettes/<?php echo $film->pochette ?>" class="img-thumbnail" alt="Image">
                    <div class="circle-rate">
                        <svg class="circle-chart" viewBox="0 0 30 30" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                            <circle class="circle-chart__background" stroke="#2f3439" stroke-width="2" fill="none" cx="15" cy="15" r="14"></circle>
                            <circle class="circle-chart__circle" stroke="#4eb04b" stroke-width="2" stroke-dasharray="<?php echo $score ?>,100" cx="15" cy="15" r="14"></circle>
                        </svg>
                        <b><?php echo $film->score ?>%</b>
                    </div>
                    <div class="hd"><?php echo $film->definition ?> <b>HD</b></div>
                </figure>
                <div class="video-content alert alert-success">
                    <h3 class="name"><i class="fas fa-film"></i>&nbsp;<?php echo $film->nom ?></h3>
                    <form action="pages/panier.php" method="POST">
                        <small>Louer pour <input type="number" name="nb_jours" value="<?php echo $_SESSION["PANIER"][$film->id] ?>"> jours</small>&nbsp;&nbsp;
                        <input type="hidden" name="id" value="<?php echo $film->id ?>" />
                        <button class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                        <h3 class="name">
                            <i class="fas fa-dollar-sign"></i> <?php echo $film->prix ?>
                        </h3>
                    </form>
                    <div class="w-100">
                        <form action="pages/panier.php" method="POST">
                            <input type="hidden" value="0" name="nb_jours" />
                            <input type="hidden" name="id" value="<?php echo $film->id ?>" />
                            <button class="btn btn-danger btn-sm btn-block">Retirer&nbsp;&nbsp;<i class="far fa-times-circle"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <?php if (count($films_in_panier) == 0) : ?>
        <div class="alert alert-danger text-center"> Votre panier est vide</div>
    <?php endif; ?>
    <div class="row total">
        <ul class="list-group w-100">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong> Total hors taxes : <?php echo sprintf("%.2f", $total_hors_taxes) ?>&nbsp;$</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Taxes : <?php echo sprintf("%.2f", $total_hors_taxes * 0.1559) ?>&nbsp;$</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Total : <?php echo sprintf("%.2f", $total_hors_taxes * 0.1559 + $total_hors_taxes) ?>&nbsp;$</strong>
            </li>
        </ul>
    </div>
    <div class="row mt-5">
        <div class="col-6">
            <a href="pages/catalogue.php" class="btn btn-primary btn-block">Continuer à magasiner&nbsp;&nbsp;<i class="fas fa-book-open"></i></a>
        </div>
        <div class="col-6">
            <a href="pages/payment.php" class="btn btn-success btn-block">Payer&nbsp;&nbsp;<i class="fas fa-comment-dollar"></i></a>
        </div>
    </div>
<?php endif; ?>

<?php
//if(isset[])
?>