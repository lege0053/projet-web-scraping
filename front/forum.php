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

        <div class="dash">
            <p>Pour voir tous les forums scapés aller ici &#x1F447;</p>
            <a class="btn btn-primary" href="TableForum.php" role="button">Table:Forum</a>
        </div>
    </div>
HTML);
  
echo $webpage->toHTML();
?>

<script>

    function corrigerFormatJSON(chaineJSON) {
        // Vérifie si la chaîne JSON commence par un crochet
        if (chaineJSON.charAt(0) !== '[') {
            chaineJSON = '[' + chaineJSON;
        }
        
        // Vérifie si la chaîne JSON se termine par un crochet
        if (chaineJSON.charAt(chaineJSON.length - 1) !== ']') {
            chaineJSON = chaineJSON + ']';
        }
        
        return chaineJSON;
    }

    // span scraper
    const scrapingTxt = document.getElementById("txt-scraper");
    // spinner
    const btnSpinner = document.getElementById("btn-spinner");

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('scrapingForum');
        const resultContainer = document.getElementById('resultContainer');
        const container = document.getElementById("container"); 

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
                fetch('./superForum',{
                    method:'POST',
                    body: formData,
                    
                })
                .then(response => response.text())
                .then(data => {
                    resultContainer.innerHTML = data;
                })
                
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

