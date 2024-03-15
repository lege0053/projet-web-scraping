<?php
require 'vendor/autoload.php';

use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

$mink = new Mink(array(
  'browser' => new Session(new ChromeDriver('http://localhost:9222', null, 'http://www.google.com')),
));

$mink->setDefaultSessionName('browser');
$session = $mink->getSession();

$session->visit('https://www.boursorama.com/');
$page = $session->getPage();

// espace membre
$btnMembre = $page->find('css','#login-member');
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

system('pause');