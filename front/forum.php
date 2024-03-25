<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("Forum");



$webpage->appendContent(<<<HTML
    <div class="">
        <form action="../api/scrapingForum.php" method="post">
            <label for="url-type-styled-input">URL de forum à WebScraper </label>
            <input type="url" name="url" id="url-type-styled-input" placeholder="https://www.boursorama.com/bourse/forum/...">
        
            <button type="submit">scraper</button>
        </form> 
    </div>
HTML);
  



echo $webpage->toHTML();
