
let listeFilms = [];
let listeCategories = [];
(($) => {
	$(() => {
		$('.sidenav').sidenav();
		$(".dropdown-trigger").dropdown();
		$('.modal').modal({
			dismissible: true,
			onCloseStart: function () { // Callback for Modal close
				if ($("#titre_film").val() && $("#annee_film").val() && $("#duree_film").val() && $("#pochette_film").val()) {
					if ($("#id_edit_film").val() == "") {
						let film = {
							"id": listeFilms.length + 2,
							"title": $("#titre_film").val(),
							"year": $("#annee_film").val(),
							"runtime": $("#duree_film").val(),
							"plot": $("#description_film").val(),
							"posterUrl": $("#pochette_film").val()
						}
						listeFilms.unshift(film);
					} else {
						let id = $("#id_edit_film").val();
						console.log(id);
						console.log(listeFilms.find(x => x.id == id));
						listeFilms.find(x => x.id == id).title = $("#titre_film").val();
						listeFilms.find(x => x.id == id).year = $("#annee_film").val();
						listeFilms.find(x => x.id == id).runtime = $("#duree_film").val();
						listeFilms.find(x => x.id == id).plot = $("#description_film").val();
						listeFilms.find(x => x.id == id).posterUrl = $("#pochette_film").val();
					}
				}
				displayList(listeFilms);
				$("#form_add_film").trigger("reset")
			},
			onOpenStart: function (modal, trigger) {
				if (trigger.dataset.url) {
					$("#iframe_bande_annaonce").attr("src", trigger.dataset.url);
				}
			},
			onOpenEnd: function () {
				M.updateTextFields();
			},
			onCloseEnd: function () {
				$('.sidenav').sidenav('close');
				$("#iframe_bande_annaonce").attr("src", "");
			}
		});
		// Chargement du fichier JSON
		$.ajax({
			"type": "POST",
			"data": { "action": "lister" },
			"url": "http://spa-serveur2.test/serveur/gestionFilms.php",
			"async": true,
			"dataType": "json",
			"success": (reponse) => {
				listeFilms = reponse;
				displayList(listeFilms);
			},
			"fail": () => {
				$("#contenu_page").html("<div class='card-panel red lighten-2'>Erreur lors du chargement de la page</div>");
			}
		});
	});
})(jQuery);

let displayList = (films) => {
	contenu = "<div class='row'>";
	for (unFilm of films) {
		contenu += remplirCard(unFilm);
	}
	contenu += "</div>";
	$("#contenu_page").html(contenu);
	paginpers();
	showPage(1);
	displayCategories();
	assign_events();
}

let displayCategories = () => {
	listeCategories = array_unique(listeCategories);
	let contenu = "<h5>Catégories</h5>"
	for (uneCateg of listeCategories) {
		contenu += remplirCateg(uneCateg);
	}
	$("#template_categories").html(contenu);
}

let remplirCateg = (uneCateg) => {
	return `
			<p class="my-0">
				<label>
					<input type="checkbox" />
					<span>${uneCateg}</span>
				</label>
			</p>
    	`;
}

var array_unique = (arrArg) => {
	return arrArg.filter((elem, pos, arr) => {
		return arr.indexOf(elem) == pos;
	});
}

let assign_events = () => {
	$('.delete_film').click(function () {
		id = $(this).data("id");
		listeFilms.splice(listeFilms.indexOf(listeFilms.find(x => x.id === id)), 1);
		displayList(listeFilms);
	});
	$('.edit_film').click(function () {
		id_edit = $(this).data("id");
		//delete_film(id);
	});
	$('.tri_titre').click(function () {
		listeFilms.sort((a, b) => (b.title < a.title) ? 1 : -1);
		displayList(listeFilms);
	});
	$('.tri_duree').click(function () {
		listeFilms.sort((a, b) => parseInt(a.runtime) - parseInt(b.runtime));
		displayList(listeFilms);
	});
	$('.tri_annee').click(function () {
		listeFilms.sort((a, b) => parseInt(a.year) - parseInt(b.year));
		displayList(listeFilms);
	})
	$('#search_text').blur(function () {
		search_film();
	});
	$('#menu_catgories').click(function () {
		$('.sidenav').sidenav('open');
	});
}

let remplirCard = (unFilm) => {
	categs_splitted = unFilm.categories.split(",");
	listeCategories = listeCategories.concat(categs_splitted);
	categs = categs_splitted.join(", ");
	return `
			<div class="col s6 m3 line-content">
				<div class="card hoverable">
					<div class="card-image">
						<img src="images/pochettes/${unFilm.pochette}" class="width_180" />
						<span class="card-title">${unFilm.nom}</span>
					</div>
					<div class="card-content">
						<p>Réalisateur : ${unFilm.realisateur}</p>
						<p>Durée : ${unFilm.duree}</p>
						<p>Date : ${unFilm.date}</p>
						<p>Prix : ${unFilm.prix} $</p>
						<p>Catégories : ${categs}</p>
					</div>
					<div class="card-action">
						<a data-url="${unFilm.url_bande_annonce}" class="waves-effect waves-light btn red modal-trigger" href="#bande_annonce"><i class="material-icons right">play_circle_outline</i>Bande annonce</a>
					</div>
				</div>
			</div>
    	`;
}

let search_film = () => {
	let search_text = $('#search_text').val();
	let films_found = listeFilms.filter(x => x.nom.search(search_text) > -1);
	displayList(films_found);
	return false;
}