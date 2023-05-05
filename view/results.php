<?php
require_once '../controller/DataSource.php';

use Phppot\DataSource;

session_start();

$ds = new DataSource();

$userAnswers = $_SESSION['userAnswers'];
$totalQuestions = $ds->getTotalQuestions();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Détruire la session
    session_destroy();
    // Rediriger vers la page home
    header('Location: home_user.php');
    exit;
}

if (!empty($userAnswers)) {
    // initialiser le tableau de scores pour chaque catégorie
    $scoresByCategory = array(
        'score_categorie_1' => 0,
        'score_categorie_2' => 0,
        'score_categorie_3' => 0,
        'score_categorie_4' => 0,
        'score_categorie_5' => 0,
        'score_categorie_6' => 0,
        'score_categorie_7' => 0,
        'score_categorie_8' => 0,
    );

    // calculer les scores pour chaque catégorie
    foreach ($userAnswers as $questionId => $userAnswer) {
        $questionScores = $ds->getScoresById($questionId);
        foreach ($questionScores as $category => $score) {
            if (strpos($userAnswer, $category) !== false) {
                $scoresByCategory[$category] += $score;
            }
        }
    }

    // afficher les résultats
    echo '<h1>Résultats</h1>';
    echo '<table>';
    echo '<thead><tr><th>Catégorie</th><th>Score moyen</th></tr></thead>';
    echo '<tbody>';
    foreach ($scoresByCategory as $category => $score) {
        $averageScore = $score / $totalQuestions;
        echo '<tr><td>' . $category . '</td><td>' . round($averageScore, 2) . '</td></tr>';
    }
    echo '</tbody></table>';
    echo '<form method="post"><button type="submit">Terminer la session</button></form>';
} else {
    echo '<h1>Aucune réponse enregistrée</h1>';
}
