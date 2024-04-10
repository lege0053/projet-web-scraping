<?php
declare(strict_types=1);

require_once "autoload.php";

$webpage = new WebPage("Home");

$webpage->appendContent(<<<HTML
    <div class="p-3">
        <h2 class="mb-3">Scraper une action</h2>
        <form id="scrapingForm">
            <div class="form-group">
                <label for="url-type-styled-input">Code du cours à WebScraper</label>
                <div class="input-group flex-nowrap mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">https://www.boursorama.com/cours/</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="url-type-styled-input" aria-describedby="basic-addon3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden ></span>
                            <span id="txt-scraper">Scraper</span>
                        </button>
                    </div>
                </div>
            </div>
        </form> 
        <div id="resultContainer"></div>
        <div id="container" class="card"></div>
    </div>
HTML);

echo $webpage->toHTML();
?>

<script>
    // span scraper
    const scrapingTxt = document.getElementById("txt-scraper");
    // spinner
    const btnSpinner = document.getElementById("btn-spinner");

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('scrapingForm');
        const resultContainer = document.getElementById('resultContainer');
        const container = document.getElementById('container');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form); // Collect form data

            scrapingTxt.textContent = "Scraping..."; // changement du text
            btnSpinner.removeAttribute("hidden"); // affichage du loader

            // AJAX request
            fetch('../api/scrapingAction.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // affichage de la reponse
                //resultContainer.innerHTML = data;
                var donnees = JSON.parse(data);
                container.innerHTML += "<div class='card-header'>Action</div>";
                container.innerHTML += "<ul class='list-group list-group-flush'>";
                // Concaténation des valeurs dans la variable container
                container.innerHTML += "<li class='list-group-item' > Code : " + donnees.code+"</li>" ;
                container.innerHTML += "<li class='list-group-item' > Date et heure : " + donnees.dateHours+"</li>" ;
                container.innerHTML += "<li class='list-group-item' >Label : " + donnees.label+"</li>" ;
                container.innerHTML += "<li class='list-group-item'  >Dernier : " + donnees.last + "</li>";
                container.innerHTML += "<li class='list-group-item'  >Ouverture : " + donnees.aOpen + "</li>";
                container.innerHTML += "<li class='list-group-item' >Fermeture : " + donnees.aClose + "</li>";
                container.innerHTML += "<li class='list-group-item' >Devise : " + donnees.currency + "</li>" ;
                container.innerHTML += "<li class='list-group-item' >Plus haut : " + donnees.high + "</li>";
                container.innerHTML += "<li class='list-group-item' >Plus bas : " + donnees.low + "</li>";
                container.innerHTML += "<li class='list-group-item' >Volume total : " + donnees.totalVolume + "</li>";
                
                var heure_actuelle = new Date().getHours();

                // Vérification si l'heure actuelle est 17 heures
                if (heure_actuelle == 17) {
                // Si l'heure est 17 heures, ajoutez un élément à la liste avec "True"
                    container.innerHTML += "<li class='list-group-item'>Fin du jour : True</li>";
                } else {
                // Si ce n'est pas 17 heures, ajoutez un élément à la liste avec "False"
                    container.innerHTML += "<li class='list-group-item end'>Fin du jour : False</li>";
                }
                            })
            .catch(error => {
                console.error('Error:', error);
                container.innerHTML += "<p> erreur lors du scrapping voir le dashboard </p>";
                //resultContainer.innerHTML = data;

            }).finally(() => {
                // text d'origine
                scrapingTxt.textContent = "Scraper";
                btnSpinner.setAttribute("hidden", true);
            });
        });
    });
</script>
