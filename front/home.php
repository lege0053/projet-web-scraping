<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("Home");



$webpage->appendContent(<<<HTML
    <div class="p-3">
        <form action="../api/scrapingAction.php" method="post">
            <label for="url-type-styled-input">URL de cours à WebScraper</label>
            <div class="input-group flex-nowrap mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">https://www.boursorama.com/cours/</span>
                </div>
                <input type="text" class="form-control" id="url-type-styled-input" aria-describedby="basic-addon3">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Scraper</button>
                </div>
            </div>

            <label for="url-type-styled-input">URL de cours à WebScraper </label>
            <input type="url" name="url" id="url-type-styled-input" placeholder="https://www.boursorama.com/cours/...">
        
            <button type="submit">scraper</button>
        </form> 
    </div>
HTML);
  



echo $webpage->toHTML();
