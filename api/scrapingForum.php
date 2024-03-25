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

// mise en db

system('pause');


