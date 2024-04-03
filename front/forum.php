<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("Forum");



$webpage->appendContent(<<<HTML
    <div class="p-3">
        <h2 class="mb-3">Scraper le forum d'une action</h2>
        <form action="../api/scrapingForum.php" method="post">
            <div class="form-group">
                <label for="url-type-styled-input">Code de l'action du forum à scraper</label>
                <div class="input-group flex-nowrap mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">https://www.boursorama.com/bourse/forum/</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="url-type-styled-input" aria-describedby="basic-addon3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Scraper</button>
                    </div>
                </div>
            </div>
        </form> 
    </div>
HTML);
  



echo $webpage->toHTML();
