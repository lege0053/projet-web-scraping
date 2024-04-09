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
        <div id="container"></div>
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

                // Accéder aux valeurs
                var dateHours = donnees.dateHours;
                var label = donnees.label;
                var last = donnees.last;
                var aOpen = donnees.aOpen;
                var aClose = donnees.aClose;
                var currency = donnees.currency;
                var high = donnees.high;
                var low = donnees.low;
                var totalVolume = donnees.totalVolume;

                // Concaténation des valeurs dans la variable container
                container.innerHTML += "<p> Date et heure : " + donnees.dateHours+"</p>" ;
                container.innerHTML += "<p>Label : " + donnees.label+"</p>" ;
                container.innerHTML += "<p>Dernier : " + donnees.last + "</p>";
                container.innerHTML += "<p>Ouverture : " + donnees.aOpen + "</p>";
                container.innerHTML += "<p>Fermeture : " + donnees.aClose + "</p>";
                container.innerHTML += "<p>Devise : " + donnees.currency + "</p>" ;
                container.innerHTML += "<p>Plus haut : " + donnees.high + "</p>";
                container.innerHTML += "<p>Plus bas : " + donnees.low + "</p>";
                container.innerHTML += "<p>Volume total : " + donnees.totalVolume + "</p>";
                            })
            .catch(error => {
                console.error('Error:', error);
            }).finally(() => {
                // text d'origine
                scrapingTxt.textContent = "Scraper";
                btnSpinner.setAttribute("hidden", true);
            });
        });
    });
</script>
