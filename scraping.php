<?php
require 'vendor/autoload.php';

use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;

$mink = new Mink(array(
  'browser' => new Session(new ChromeDriver('http://localhost:9222', null, 'http://www.google.com')),
));

$mink->setDefaultSessionName('browser');
$session = $mink->getSession();

$session->visit('https://www.boursorama.com/cours/1rPALATI/');
$page = $session->getPage();

$dateHeure = new DateTime();
$label = $page->find('css','a.c-faceplate__company-link')->getText();
$cours = $page->find('css','span.c-instrument.c-instrument--last')->getText();
$devise = $page->find('css','span.c-faceplate__price-currency')->getText();

var_dump($devise);


//cours, cours d’ouverture, cours haut, cours bas, volumes

system('pause');

?>