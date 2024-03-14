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

$session->visit('https://www.boursorama.com/');
$page = $session->getPage();

system('pause');

//date/heure de collecte, cours, cours d’ouverture, cours haut, cours bas, volumes
?>