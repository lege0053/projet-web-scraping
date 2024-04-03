<?php
require 'vendor/autoload.php';

use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

$mink = new Mink(array(
  'browser' => new Session(new ChromeDriver('http://localhost:9222', null, 'http://www.google.com', ['downloadBehavior'=> 'allow','downloadPath'=> __DIR__])),
));

$mink->setDefaultSessionName('browser');
$session = $mink->getSession();

$session->visit('https://www.boursorama.com/');
$page = $session->getPage();

// espace membre
$btnMembre = $page->find('css','#login-member');
// si déjà connecté
if($btnMembre) {
  $btnMembre->click();

  // login
  $inputPseudo = $page->find('css','#login_member_login');
  $inputPseudo->setValue($_ENV['PSEUDO']);

  // password
  $inputPassword = $page->find('css','#login_member_password');
  $inputPassword->setValue($_ENV['MDP']);

  // bouton connexion
  $btnConnexion = $page->find('css','#login_member_connect');
  $btnConnexion->click();

  sleep(2);
}

if(isset($_POST['actions'])) {
  // actions bourse de paris
  $actions = $_POST['actions'];
  $session->visit('https://www.boursorama.com/connexion/?org=/espace-membres/telecharger-cours/paris');
} else if(isset($_POST['actions-int'])) {
  // actions international
  $actions = $_POST['actions-int'];
  $session->visit('https://www.boursorama.com/connexion/?org=/espace-membres/telecharger-cours/international');
}
$page = $session->getPage();

// select action
$btnActions = $page->find('css', '#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div > div > form > div:nth-child(3) > div > ul > li.o-list__item.u-1\/2\@sm-min.u-1\/3\@md-min > div.c-select.o-accordion-content > div > div.c-select__textbox');
$btnActions->click(); //ouvre le select
$selectActions = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div > div > form > div:nth-child(3) > div > ul > li.o-list__item.u-1\/2\@sm-min.u-1\/3\@md-min > div.c-select.o-accordion-content.is-expanded > div > div.c-select__listbox.is-open > div:nth-child('.$actions.')');
$selectActions->click();

// format
$btnFormat = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div > div > form > div.o-grid.o-grid--middle > div:nth-child(1) > div > div > div.c-select__textbox');
$btnFormat->click();  //ouvre le select
$excelFormat = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div > div > form > div.o-grid.o-grid--middle > div:nth-child(1) > div > div > div.c-select__listbox.is-open > div:nth-child(9)');
$excelFormat->click();

$btnDownload = $page->find('css','input[value="Télécharger"]');
$btnDownload->click();

sleep(5);