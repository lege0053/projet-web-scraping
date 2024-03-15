<?php
declare(strict_types=1);
require 'vendor/autoload.php';

require "../front/autoload.php";

$actions = Action::getAll();
var_dump($actions);
// Afficher les informations sur chaque action
foreach ($actions as $action) {
    //echo "ID : " . $action->getIdAction() . "<br>";
    echo "Label : " . $action->getLabel() . "<br>";
    echo "Last : " . $action->getLast() . "<br>";
    // Ajoutez d'autres propriétés selon vos besoins
    echo "<hr>";
}