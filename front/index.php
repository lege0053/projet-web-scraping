<?php

declare(strict_types=1);

require_once "autoload.php";


$webpage = new WebPage("DSM : Accueil ");



$webpage->appendContent(<<<HTML
    <div class=" ">
        <header>
        <nav class="navbar">
            <img id="logo" src="src/img/bourse.png" alt="">
            <h1>PigStock</h1>
            <ul class="items">
                <li><a href="#">Accueil</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        </header>
      
        
        <form>
            <label for="url-type-styled-input">URL à WebScrapper </label>
            <input type="url" id="url-type-styled-input" placeholder="https://www.boursorama.com/...">
        
            <button class="" type="button">scrapper</button>
        </form>

        


        
    </div>
HTML);
  



echo $webpage->toHTML();
