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

$code = $_POST['code'];

//var_dump($code);

$session->visit("https://www.boursorama.com/cours/".$code);
$page = $session->getPage();
$date = (new DateTime())->format('Y-m-d H:i:s');
// récupération des données
$data = array(
  'code' => $code,
  'dateHours' => $date,
  'label' => $page->find('css','a.c-faceplate__company-link')->getText(),
  'last' => $page->find('css','span.c-instrument.c-instrument--last')->getText(),
  'aOpen' => $page->find('css','span.c-instrument--open')->getText(),
  'aClose' => $page->find('css','span.c-instrument--previousclose')->getText(),
  'currency' => $page->find('css','span.c-faceplate__price-currency')->getText(),
  'high' => $page->find('css','span.c-instrument--high')->getText(),
  'low' => $page->find('css','span.c-instrument--low')->getText(),
  'totalVolume' => $page->find('css','span.c-instrument--totalvolume')->getText()
);
$json_data = json_encode($data);

echo $json_data;

//var_dump($data);
// Récupération de l'heure actuelle
$heure_actuelle = date('H');

// Vérification si l'heure actuelle est 17 heures
if ($heure_actuelle > 17 && $heure_actuelle < 0) {
  $req = MyPDO::getInstance()->prepare(<<<SQL
  INSERT INTO action (`code`,`label`,`last`,`dateHours`,  `aClose`, `aOpen`, `currency`, `high`, `low`, `totalVolume`,`endOfTheDay`) 
  VALUES (:code,:label,:last, :dateHours,   :aOpen, :aClose, :currency, :high, :low, :totalVolume,"True")
SQL);
} else {
    $req = MyPDO::getInstance()->prepare(<<<SQL
    INSERT INTO action (`code`,`label`,`last`,`dateHours`,  `aClose`, `aOpen`, `currency`, `high`, `low`, `totalVolume`,`endOfTheDay`) 
    VALUES (:code,:label,:last, :dateHours,   :aOpen, :aClose, :currency, :high, :low, :totalVolume,"False")
SQL);
}


$req->execute($data);


