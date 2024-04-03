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
    </div>
HTML);

echo $webpage->toHTML();
?>

<script>
    const scrapingTxt = document.getElementById("txt-scraper");
    const btnSpinner = document.getElementById("btn-spinner");

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('scrapingForm');
        const resultContainer = document.getElementById('resultContainer');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(form); // Collect form data

            scrapingTxt.textContent = "Scraping...";
            btnSpinner.removeAttribute("hidden");

            // Send AJAX request
            fetch('../api/scrapingAction.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Convert response to text
            .then(data => {
                // Display response on the page
                resultContainer.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            }).finally(() => {
                scrapingTxt.textContent = "Scraper";
                btnSpinner.setAttribute("hidden", true);
            });
        });
    });
</script>
