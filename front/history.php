<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("History");



$webpage->appendContent(<<<HTML
    <div class="">
        <form action="../api/scrapingHistorique.php" method="post">
            <label for="actions-select">Historique à télécharger </label>
            <select name="actions" id="actions-select">
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
            <button type="submit">Télécharger</button>
        </form> 
    </div>
HTML);




echo $webpage->toHTML();
