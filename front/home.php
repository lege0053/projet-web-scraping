<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("DSM : Accueil ");



$webpage->appendContent(<<<HTML
    <div class=" ">
        
      
        
        <form>
            <label for="url-type-styled-input">URL à WebScraper </label>
            <input type="url" id="url-type-styled-input" placeholder="https://www.boursorama.com/...">
        
            <button class="" type="button">scraper</button>
        </form>

        


        
    </div>
HTML);
  



echo $webpage->toHTML();
