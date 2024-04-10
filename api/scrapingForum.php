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
//$json_code = json_encode($code);

//echo $json_code; 
//var_dump($code);

$url = "https://www.boursorama.com/bourse/forum/".$code;

$session->visit($url);
$page = $session->getPage();

// récupération des données
$data = array();
$rows = $page->findAll('css', 'table > tbody > tr');
$current = 0;

foreach ($rows as $row) {
    if($current <=40) {
        $current++;
        $subject = $row->find('css','td:nth-child(2) > div > a');
        if($subject) {
            $subject->click();
            $auteur = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > div.c-profile-card.\/.o-flag.o-flag--top > div.c-profile-card__body.\/.o-flag__body > div > div.o-ellipsis-container > div.c-profile-card__name > button')->getText();
            $date = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > div.c-profile-card.\/.o-flag.o-flag--top > div.c-profile-card__body.\/.o-flag__body > div > div.c-source > span:nth-child(1)')->getText();
            $heure = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > div.c-profile-card.\/.o-flag.o-flag--top > div.c-profile-card__body.\/.o-flag__body > div > div.c-source > span:nth-child(3)')->getText();
            $contenu = $page->find('css','#main-content > div > div.l-basic-page > div.l-basic-page__sticky-container > div.l-basic-page__main > div:nth-child(3) > div > div.c-block > div.c-block__body.c-block__body--keep-border\@xs-max.c-block__body--keep-padding\@xs-max > div.c-message > p')->getText();
            $add_data = array(
                'codeAction' => $code,
                'auteur' => $auteur,
                'dateForum' => $date,
                'hoursForum' => $heure,
                'content' => $contenu
            );
            
            array_push($data,$add_data);
            $req = MyPDO::getInstance()->prepare(<<<SQL
            INSERT INTO forum (`codeAction`,`auteur`, `dateForum`, `hoursForum`, `content`) 
            VALUES (:codeAction, :auteur, :dateForum, :hoursForum, :content)
            SQL);
            $req->execute($add_data);        
            $session->visit($url);
        }
    } else {
        break;
    }
}
$json_data = json_encode($data);

echo $json_data;


//var_dump($data);