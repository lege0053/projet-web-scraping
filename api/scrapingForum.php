<?php
declare(strict_types=1);
require 'vendor/autoload.php';
require "../front/autoload.php";


use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;

$mink = new Mink(array(
  'browser' => new Session(new ChromeDriver('http://localhost:9222', null, 'http://www.google.com')),
));

$mink->setDefaultSessionName('browser');
$session = $mink->getSession();

$url = $_POST['url'];
$pos = strpos($url, 'bourse/forum/');
$code = substr($url, $pos + strlen('bourse/forum/'));
$code = rtrim($code, '/');

var_dump($code);

$session->visit($url);
$page = $session->getPage();

// récupération des données
$subject = $page->find('css','table > tbody > tr:nth-child(1) > td:nth-child(2) > div > a');
$subject->click();

$auteur = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > div.c-profile-card.\/.o-flag.o-flag--top > div.c-profile-card__body.\/.o-flag__body > div > div.o-ellipsis-container > div.c-profile-card__name > button')->getText();
var_dump($auteur);

$date = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > div.c-profile-card.\/.o-flag.o-flag--top > div.c-profile-card__body.\/.o-flag__body > div > div.c-source > span:nth-child(1)')->getText();
var_dump($date);

$heure = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > div.c-profile-card.\/.o-flag.o-flag--top > div.c-profile-card__body.\/.o-flag__body > div > div.c-source > span:nth-child(3)')->getText();
var_dump($heure);

$contenu = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > p')->getText();
var_dump($contenu);

$retour = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > a:nth-child(2)');
$retour->click();



