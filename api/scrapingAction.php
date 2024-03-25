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
$pos = strpos($url, 'cours/');
$code = substr($url, $pos + strlen('cours/'));
$code = rtrim($code, '/');

var_dump($code);

$session->visit($url);
$page = $session->getPage();

// récupération des données
$data = array(
  'dateHours' => (new DateTime())->format('Y-m-d H:i:s'),
  'label' => $page->find('css','a.c-faceplate__company-link')->getText(),
  'last' => $page->find('css','span.c-instrument.c-instrument--last')->getText(),
  'aOpen' => $page->find('css','span.c-instrument--open')->getText(),
  'aClose' => $page->find('css','span.c-instrument--previousclose')->getText(),
  'currency' => $page->find('css','span.c-faceplate__price-currency')->getText(),
  'high' => $page->find('css','span.c-instrument--high')->getText(),
  'low' => $page->find('css','span.c-instrument--low')->getText(),
  'totalVolume' => $page->find('css','span.c-instrument--totalvolume')->getText()
);

var_dump($data);

$req = MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO action (`dateHours`, `label`, `last`, `aClose`, `aOpen`, `currency`, `high`, `low`, `totalVolume`) 
        VALUES (:dateHours, :label, :last, :aOpen, :aClose, :currency, :high, :low, :totalVolume)
SQL);

$req->execute($data);


