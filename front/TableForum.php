<?php

declare(strict_types=1);

require_once "autoload.php";
require_once "../api/forum.php";

$webpage = new WebPage("TableForum");

$webpage->appendContent(<<<HTML
    <div class="p-3">
        <h2>Table:Forum</h2>
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Id_Forum</th>
                    <th scope="col">codeAction</th>
                    <th scope="col">auteur</th>
                    <th scope="col">dateForum</th>
                    <th scope="col">hoursForum</th>
                    <th scope="col">content</th>
                </tr>
            </thead>
            <tbody>
HTML);

$forums = Forum::getAll();

// Supposons que $forums soit le tableau contenant vos objets "Forum"
foreach ($forums as $forum) {
    // Utilisation de la réflexion pour accéder aux propriétés de l'objet
    $reflectionClass = new ReflectionClass($forum);
    $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PRIVATE);

    // Début de la boucle pour chaque forum
    foreach ($properties as $property) {
        // Rendre la propriété accessible
        $property->setAccessible(true);

        // Afficher le nom de la propriété
        $propertyName = $property->getName();

        // Afficher la valeur de la propriété
        $propertyValue = $property->getValue($forum);

        $webpage->appendContent(<<<HTML
            <tr>
                
        HTML);
        foreach ($propertyValue  as $key => $value) {
            if($value == null) {
                $webpage->appendContent(<<<HTML
                <td>vide</td>
            HTML);
            } else{
                $webpage->appendContent(<<<HTML
                    <td>$value</td>
                HTML);
            }
        }

        $webpage->appendContent(<<<HTML
            </tr>
        HTML);
    }
    // Fin de la boucle pour chaque forum
}

$webpage->appendContent(<<<HTML
        </tbody>
    </table>
</div>
HTML);

echo $webpage->toHTML();
