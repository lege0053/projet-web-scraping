<?php

declare(strict_types=1);

require_once "autoload.php";

require_once "../api/action.php";

$webpage = new WebPage("Dashboard");

$actions = Action::getAll();


// Supposons que $actions soit le tableau contenant vos objets "Action"
foreach ($actions as $action) {
    // Utilisation de la réflexion pour accéder aux propriétés de l'objet
    $reflectionClass = new ReflectionClass($action);
    $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PRIVATE);

    // Boucle à travers les propriétés
    foreach ($properties as $property) {
        // Rendre la propriété accessible
        $property->setAccessible(true);
        
        // Afficher le nom de la propriété
        $propertyName = $property->getName();
       

        // Afficher la valeur de la propriété
        $propertyValue = $property->getValue($action);

    }
}


$webpage->appendContent(<<<HTML
    <div class="">
        <h1>Dashboard</h1>
        <p></p>

    </div>
  HTML);


foreach ($propertyValue  as $key => $value) {
    //var_dump($key,$value);
    $webpage->appendContent(<<<HTML
        <p>$key : $value <p>
    HTML);
}

  

echo $webpage->toHTML();