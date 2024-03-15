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

$p = $_POST['url'];
var_dump($p);

$url = 'https://www.boursorama.com/cours/1rPAB/';
$pos = strpos($url, 'cours/');
$code = substr($url, $pos + strlen('cours/'));
$code = rtrim($code, '/');

var_dump($code);

$session->visit($url);
$page = $session->getPage();

// récupération des données
$dateHeure = new DateTime();
$dateHeureString = $dateHeure->format('Y-m-d H:i:s');
$label = $page->find('css','a.c-faceplate__company-link')->getText();
$cours = $page->find('css','span.c-instrument.c-instrument--last')->getText();
$devise = $page->find('css','span.c-faceplate__price-currency')->getText();
$ouverture = $page->find('css','span.c-instrument--open')->getText();
$fermeture = $page->find('css','span.c-instrument--previousclose')->getText();
$haut = $page->find('css','span.c-instrument--high')->getText();
$bas = $page->find('css','span.c-instrument--low')->getText();
$volume = $page->find('css','span.c-instrument--totalvolume')->getText();

var_dump($dateHeure);
var_dump($label);
var_dump($cours);
var_dump($devise);
var_dump($ouverture);
var_dump($fermeture);
var_dump($haut);
var_dump($bas);
var_dump($volume);

$req = MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO action (`dateHours`, `label`, `last`, `aClose`, `aOpen`, `currency`, `high`, `low`, `totalVolume`) 
        VALUES (:dateHours, :label, :last, :aOpen, :aClose, :currency, :high, :low, :totalVolume)
SQL);

$req->execute(array(
    'dateHours' => $dateHeureString,
    'label' => $label,
    'last' => $cours,
    'aOpen' => $ouverture,
    'aClose' => $fermeture,
    'currency' => $devise,
    'high' => $haut,
    'low' => $bas,
    'totalVolume' => $volume
));

system('pause');


