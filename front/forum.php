<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("Forum");



$webpage->appendContent(<<<HTML
    <div class="p-3">
        <h2 class="mb-3">Scraper le forum d'une action</h2>
        <form id="scrapingForum">
            <div class="form-group">
                <label for="url-type-styled-input">Code de l'action du forum à scraper</label>
                <div class="input-group flex-nowrap mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">https://www.boursorama.com/bourse/forum/</span>
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
        const form = document.getElementById('scrapingForum');
        const resultContainer = document.getElementById('resultContainer');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form); // Collect form data

            scrapingTxt.textContent = "Scraping..."; // changement du text
            btnSpinner.removeAttribute("hidden"); // affichage du loader

            // AJAX request
            fetch('../api/scrapingForum.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // affichage de la reponse
                resultContainer.innerHTML = data;
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

