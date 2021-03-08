<!DOCTYPE html>
<html>

<head>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="ico/favicon.png" rel="shortcut icon">
    <!--Import Google Icon Font-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="#!" class="tri_titre">Titre</a></li>
            <li class="divider"></li>
            <li><a href="#!" class="tri_annee">Année</a></li>
            <li class="divider"></li>
            <li><a href="#!" class="tri_duree">Durée</a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="#!" class="tri_titre">Titre</a></li>
            <li class="divider"></li>
            <li><a href="#!" class="tri_annee">Année</a></li>
            <li class="divider"></li>
            <li><a href="#!" class="tri_duree">Durée</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper grey darken-4">
                <a href="index.php" class="brand-logo hide-on-small-only" style="text-decoration:none"><img src="images/logo.png" class="logo" alt="Dfilm" /></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <form class="right" onsubmit="return search_film()">
                    <div class="input-field">
                        <input type="search" required id="search_text">
                        <label class="label-icon" for="search_text"><i class="material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
                <ul class="right hide-on-med-and-down">
                    <li><a class="btn-floating waves-effect waves-light red modal-trigger" href="#modal1" id=""><i class="material-icons">add</i></a></li>
                    <li><a href="#!" id="menu_catgories">Catégories</a></li>
                    <!-- Dropdown Trigger -->
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Trier par<i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li class="hide-on-large-only"><a class="dropdown-trigger" href="#!" data-target="dropdown1">Trier par<i class="material-icons right">arrow_drop_down</i></a></li>
            <li class="hide-on-large-only">
                <a class="waves-effect waves-light modal-trigger" href="#modal1"><i class="material-icons">add</i>button</a>
            </li>
            <li>
                <div class="container">
                    <div class="row" id="template_categories">
                    </div>
                    <button id="refine_categories" class="btn waves-effect waves-light red" type="submit" name="action">Raffiner
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </li>
        </ul>
        <div class="paginate" id="main_part">
            <div class="section items container" id="contenu_page">
                <div class="valign-wrapper loading">
                    <h2 class="center-align">Chargement</h2>
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-green-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="center-align">
                <div class="container">
                    <ul id="pagin" class="pagination">

                    </ul>
                    <br><br>
                </div>
            </div>
        </div>
    </main>
    <footer class="page-footer red">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Collège Ahuntsic</h5>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Par Fahmi Derbali
            </div>
        </div>
    </footer>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Ajouter / Éditer Film</h4>
        </div>
        <div class="row">
            <form class="col s12" id="form_add_film">
                <input type="hidden" value="" id="id_edit_film" />
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Titre" id="titre_film" type="text" class="validate">
                        <label for="titre_film">Titre du film</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Durée" id="duree_film" type="number" class="validate">
                        <label for="duree_film">Durée du film</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Année" id="annee_film" type="number" class="validate">
                        <label for="annee_film">Année du film</label>
                    </div>
                    <div class="input-field col s6">
                        <textarea id="description_film" class="materialize-textarea"></textarea>
                        <label for="description_film">Description du film</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Pochette" id="pochette_film" type="text" class="validate">
                        <label for="pochette_film">Pochette du film</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="save_film">Enregistrer</a>
        </div>
    </div>

    <!-- Modal Bande annonce -->
    <div id="bande_annonce" class="modal">
        <!--div class="modal-content">
            <h4>Bande Annonce</h4>
        </!--div-->
        <div class="row">
            <div class="col s12">
                <iframe width="900" height="506" src="" id="iframe_bande_annaonce" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="save_film">Fermer</a>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/paginpers.js"></script>
    <script src="js/init.js"></script>

</body>

</html>