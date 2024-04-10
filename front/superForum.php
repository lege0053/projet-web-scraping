<?php

declare(strict_types=1);

require_once "./autoload.php";
require_once "../api/forum.php";

$code = $_POST['code'];
$codeChaine = (string)$code;
$html = <<<HTML
    <div class="p-3">
        <h3>Forum de l'action $codeChaine </h3>
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Id Forum</th>
                    <th scope="col">Id Action</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Contenu</th>
                </tr>
            </thead>
        <tbody>
HTML;

$actions = Forum::getAllByCodeAction($codeChaine);

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

        $html.=<<<HTML
            <tr>
                
        HTML;
        foreach ($propertyValue  as $key => $value) {
            if($value == null) {
                $html.=<<<HTML
                <td>vide</td>
            HTML;
            } else{
               
                $html.=<<<HTML
                    <td>$value</td>
                HTML;
                
            }
        }

        $html.=<<<HTML
            </tr>
        HTML;
    }
    // Fin de la boucle pour chaque action
}

$html.=<<<HTML
        </tbody>
    </table>
</div>
HTML;

echo $html;
