<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("History");



$webpage->appendContent(<<<HTML
    <div class="">
        <form action="../api/scrapingHistorique.php" method="post">
            <label for="url-type-styled-input">URL de l'historique à WebScraper </label>
            <input type="url" name="url" id="url-type-styled-input" placeholder="https://www.boursorama.com/cours/...">
        
            <button type="submit">scraper</button>
        </form> 
    </div>
HTML);
  



echo $webpage->toHTML();
