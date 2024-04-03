<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("History");



$webpage->appendContent(<<<HTML
    <div class="p-3">
        <h2 class="mb-3">Historique à télécharger</h2>
        <form class="mb-3" id="scrapingHistory">
            <label for="actions-select">Bourse de Paris</label>
            <div class="input-group">
                <select class="custom-select" name="actions" id="actions-select">
                    <option value="1">Actions éligibles au SRD</option>
                    <option value="2">Compartiment A</option>
                    <option value="3">Compartiment B</option>
                    <option value="4">Compartiment C</option>
                    <option value="5">Euronext Growth</option>
                    <option value="6">Autres titres</option>
                    <option value="7">Euronext Access</option>
                    <option value="8">Indice CAC 40</option>
                    <option value="9">Indice SBF 120</option>
                    <option value="10">Indice CAC All-Tradable</option>
                    <option value="11">Toutes les actions bourses de Paris</option>
                    <option value="12">Fond</option>
                    <option value="13">Trackers</option>
                    <option value="14">Warrants</option>
                    <option value="15">Indices Paris</option>
                    <option value="16">ESTX50 EUR P</option>
                    <option value="17">Obligations</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="btn-download">
                        <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden ></span>
                        <span id="txt-scraper">Télécharger</span>
                    </button>                
                </div>
            </div>
        </form> 

        <form class="mb-3" id="scrapingHistoryInter">
            <label for="actions-international">International</label>
            <div class="input-group">
                <select class="custom-select" name="actions-int" id="actions-international">
                    <option value="1">Etats Unis : Indice Nasdaq 100</option>
                    <option value="2">Allemagne : Indice DAX</option>
                    <option value="3">Royaume-Uni : Indice Footsie 100</option>
                    <option value="4">Belgique : Indice BEL20</option>
                    <option value="5">Suisse : Indice SMI</option>
                    <option value="6">Espagne : Indice IBEX35</option>
                    <option value="7">Pays-Bas : Indice AEX25</option>
                    <option value="8">Italie: Indice FTSE MIB</option>
                    <option value="9">Indices internationaux</option>
                    <option value="10">Devises</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="btn-download2">
                        <span id="btn-spinner2" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden ></span>
                        <span id="txt-scraper2">Télécharger</span>
                    </button>
                </div>
            </div>
        </form> 
    </div>
HTML);

echo $webpage->toHTML();
?>

<script>
    function clickOnSubmitBtn(event, formulaire, btn) {
        event.preventDefault();

        btn.setAttribute("disabled", true); // desactive le bouton
        btn.children[0].removeAttribute("hidden"); // affiche le loader
        btn.children[1].textContent = "Téléchargement..."; // change le text

        // AJAX
        fetch('../api/scrapingHistorique.php', {
            method: 'POST',
            body: new FormData(formulaire)
        })
        .then(response => response.text())
        .then(data => {})
        .catch(error => {
            console.error('Error:', error);
        }).finally(() => {
            btn.removeAttribute("disabled"); // reactive le bouton
            btn.children[0].setAttribute("hidden", true); // cache le loader
            btn.children[1].textContent = "Télécharger"; // text d'origine
        });
    };

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('scrapingHistory');
        const btn = document.getElementById("btn-download");
        form.addEventListener('submit', function (event) {
            clickOnSubmitBtn(event, form, btn);
        });

        const form2 = document.getElementById('scrapingHistoryInter');
        const btn2 = document.getElementById("btn-download2");
        form2.addEventListener('submit', function (event) {
            clickOnSubmitBtn(event, form2, btn2);
        });
    });
</script>