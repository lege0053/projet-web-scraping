<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("Home");



$webpage->appendContent(<<<HTML
    <div class="">
        <form action="../api/scrapingAction.php" method="post">
            <label for="url-type-styled-input">URL à WebScraper </label>
            <input type="url" name="url" id="url-type-styled-input" placeholder="https://www.boursorama.com/...">
        
            <button type="submit">scraper</button>
        </form> 
    </div>
HTML);
  



echo $webpage->toHTML();
