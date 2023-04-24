<!DOCTYPE html>
<html lang="en">

<?php

use Phppot\Member;

require '../lib/DataSource.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // Requête SQL pour récupérer toutes les données de la table "users"
    $sql = "SELECT * FROM tdp_questions";
    $result = $conn->query($sql);

    // Vérification si la requête a renvoyé des résultats
    if ($result->num_rows > 0) {
        // Boucle pour parcourir tous les résultats
        while ($row = $result->fetch_assoc()) {
            // Affichage des données
            echo "ID: " . $row["question_id"] . " - question: " . $row["quiz_question"] . "<br>";
        }
    } else {
        echo "Aucun résultat trouvé.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
    ?>

</body>

</html>