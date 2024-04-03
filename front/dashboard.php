<?php

declare(strict_types=1);

require_once "autoload.php";
require_once "../api/action.php";

$webpage = new WebPage("Dashboard");

$webpage->appendContent(<<<HTML
    <div class="p-3">
        <h2>Dashboard</h2>
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Id_Action</th>
                    <th scope="col">idLabel</th>
                    <th scope="col">label</th>
                    <th scope="col">last</th>
                    <th scope="col">dateHours</th>
                    <th scope="col">aClose</th>
                    <th scope="col">aOpen</th>
                    <th scope="col">currency</th>
                    <th scope="col">high</th>
                    <th scope="col">low</th>
                    <th scope="col">totalVolume</th>
                    <th scope="col">ticket</th>
                </tr>
            </thead>
            <tbody>
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
            <tr>
                <th scope="row"> $propertyValue[Id_Action] </h1>
        HTML);

        foreach ($propertyValue  as $key => $value) {
            $webpage->appendContent(<<<HTML
                <td>$value</td>
            HTML);
        }

        $webpage->appendContent(<<<HTML
            </tr>
        HTML);
    }
    // Fin de la boucle pour chaque action
}

$webpage->appendContent(<<<HTML
        </tbody>
    </table>
</div>
HTML);

echo $webpage->toHTML();
