<?php

declare(strict_types=1);

require_once "autoload.php";
require_once "../api/action.php";

$webpage = new WebPage("Dashboard");

$webpage->appendContent(<<<HTML
    <div class="">
        <h1 class="titre">Dashboard</h1>
            <div class="cards">
HTML);

$actions = Action::getAll();

// Supposons que $actions soit le tableau contenant vos objets "Action"
foreach ($actions as $action) {
    // Utilisation de la réflexion pour accéder aux propriétés de l'objet
    $reflectionClass = new ReflectionClass($action);
    $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PRIVATE);

    // Début de la boucle pour chaque action
    foreach ($properties as $property) {
        // Rendre la propriété accessible
        $property->setAccessible(true);

        // Afficher le nom de la propriété
        $propertyName = $property->getName();

        // Afficher la valeur de la propriété
        $propertyValue = $property->getValue($action);

        $webpage->appendContent(<<<HTML
            <div class="action">
                <h1 > $propertyValue[Id_Action] </h1>
        HTML);

        foreach ($propertyValue  as $key => $value) {
            $webpage->appendContent(<<<HTML
                <p>$key : $value </p>
            HTML);
        }

        $webpage->appendContent(<<<HTML
            </div> <!-- Fermeture de la balise div "action" -->
        HTML);
    }
    // Fin de la boucle pour chaque action
}

$webpage->appendContent(<<<HTML
    </div> <!-- Fermeture de la balise div "cards" -->
</div> <!-- Fermeture de la balise div principale -->
HTML);

echo $webpage->toHTML();
