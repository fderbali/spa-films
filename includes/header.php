<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">
	<meta name="theme-color" content="#e90101" />
	<title>DFilm</title>
	<meta name="author" content="Fahmi Derbali">
	<meta name="description" content="Site de streaming video">
	<base href="<?php echo $relative_path_to_web_root ?>" />
	<!-- FAVICON FILE -->
	<link href="assets/ico/favicon.png" rel="shortcut icon">

	<!-- CSS FILES -->
	<link rel="stylesheet" href="assets/css/lineicons.css">
	<link rel="stylesheet" href="assets/css/fancybox.min.css">
	<link rel="stylesheet" href="assets/css/swiper.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
	<?php
	$current_file = $_SERVER["REQUEST_URI"];
	if (preg_match("/catalogue/", $current_file)) {
		echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css" />';
		echo '<link rel="stylesheet" href="assets/css/catalogue.css">';
	} elseif (preg_match("/panier|payment|locations/", $current_file)) {
		echo '<link rel="stylesheet" href="assets/css/panier.css">';
	} else {
		echo '<link rel="stylesheet" href="assets/css/slider.css">';
	}
	?>
</head>

<body>

	<?php
	if ((!isset($_SESSION["username"]) || empty($_SESSION["username"])) && (preg_match("/membre\.php|panier|payment/", $current_file))) {
		echo "<div class='container-fluid mt-5'>";
		echo "<div class='alert alert-danger font-weight-bold text-center'>
			Cette section est réservée pour les membres seulements. Veuillez vous connceter d'abord !<br /><br />
			<a class='btn btn-success' href='/serveur/membres/formulaire_connexion.php'>Connexion&nbsp;<i class='lni lni-enter'></i></a>
		</div>";
		echo "</div>";
		echo "</body>";
		echo "
</html>";
		exit;
	}
	?>
	<nav class="mobile-menu">
		<div class="inner">
			<div class="mobile-search">
				<h6>Tapez le titre du film à trouver&nbsp:</h6>
				<form>
					<input type="search" placeholder="Search here">
					<input type="submit" value="Chercher">
				</form>
			</div>
			<!-- end mobile-search -->
			<?php if (isset($_SESSION["username"])) : ?>
				<a href="pages/membre.php" class="button-account"><?= $_SESSION["username"] ?></a>
			<?php endif; ?>
			<!-- end button-account -->
			<div class="site-menu">
				<ul>
					<li><a href="index.php"><i class="lni lni-home"></i>&nbsp;ACCUEIL</a></li>
					<li><a href="catalogue.php"><i class="lni lni-home"></i>&nbsp;CATALOGUE</a></li>
					<?php if (isset($_SESSION["username"])) : ?>
						<li><a href="serveur/membres/deconnexion.php"><i class="lni lni-enter"></i>&nbsp;SE DÉCONNECTER</a></li>
					<?php else : ?>
						<li><a href="serveur/membres/formulaire_enregistrement.php"><i class="lni lni-users"></i>&nbsp;DEVENIR MEMBRE</a></li>
						<li><a href="serveur/membres/formulaire_connexion.php"><i class="lni lni-enter"></i>&nbsp;SE CONNECTER</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<!-- end site-menu -->
		</div>
		<!-- end inner -->
	</nav>
	<!-- end mobile-menu -->
	<nav class="navbar">
		<div class="logo"> <a href="index.php"> <img src="ressources/images/logo.png" alt="Image"> </a> </div>
		<!-- end logo -->
		<div class="site-menu">
			<ul>
				<li><a href="index.php"><i class="lni lni-home"></i>&nbsp;ACCUEIL</a></li>
				<li><a href="pages/catalogue.php"><i class="fas fa-book-open"></i>&nbsp;CATALOGUE</a></li>
				<?php if (isset($_SESSION["username"])) : ?>
					<li><a href="serveur/membres/deconnexion.php"><i class="lni lni-enter"></i>&nbsp;SE DÉCONNECTER</a></li>
				<?php else : ?>
					<li><a href="serveur/membres/formulaire_enregistrement.php"><i class="lni lni-users"></i>&nbsp;DEVENIR MEMBRE</a></li>
					<li><a href="serveur/membres/formulaire_connexion.php"><i class="lni lni-exit"></i>&nbsp;SE CONNECTER</a></li>
				<?php endif; ?>
			</ul>
		</div>
		<!-- end site-menu -->

		<div class="user-menu">
			<div class="navbar-search"> <i class="lni lni-search-alt"></i> </div>
			<?php if (isset($_SESSION["username"])) : ?>
				<!-- end navbar-search -->
				<div class="navbar-notify"> <i class="lni lni-alarm"></i><b>1</b>
					<!-- end notify-dropdown -->
				</div>
				<div class="navbar-notify">
					<a id="icon-cart" href="pages/panier.php"><i class="fas fa-shopping-cart"></i><?= isset($_SESSION["PANIER"]) && count($_SESSION["PANIER"]) > 0  ? "<b>" . count($_SESSION["PANIER"]) . "</b>" : "" ?></a>
				</div>
				<!-- end navbar-notify -->
				<div class="navbar-account"> <a href="pages/membre.php"><?= $_SESSION["username"] ?><i class="lni lni-user"></i> </a></div>
				<!-- end navbar-account -->
			<?php endif; ?>
		</div>

		<!-- end user-menu -->
		<div class="hamburger-menu">
			<button class="hamburger">
				<svg width="45" height="45" viewBox="0 0 100 100">
					<path class="line line1" d="M 20,29.000046 H 80.000231 C
              80.000231,29.000046 94.498839,28.817352 94.532987,66.711331
              94.543142,77.980673 90.966081,81.670246 85.259173,81.668997
              79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L
              25.000021,25.000058" />
					<path class="line line2" d="M 20,50 H 80" />
					<path class="line line3" d="M 20,70.999954 H 80.000231 C
                  80.000231,70.999954 94.498839,71.182648 94.532987,33.288669
                  94.543142,22.019327 90.966081,18.329754 85.259173,18.331003
                  79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L
                  25.000021,74.999942" />
				</svg>
			</button>
		</div>
		<!-- end hamburger-menu -->
	</nav>
	<!-- end navbar -->
	<section class="search-box">
		<div class="container">
			<h6>Taper le nom du film à chercher</h6>
			<form>
				<input type="search" placeholder="Search here">
				<input type="submit" value="FIND">
			</form>
		</div>
		<!-- end container -->
	</section>