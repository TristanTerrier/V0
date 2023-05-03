<?php
session_start();
session_destroy();
header('Location: quiz.php');
exit;

require_once '../controler/DataSource.php';

use Phppot\DataSource;

$ds = new DataSource();

if (!isset($_SESSION['questionId'])) {
    // initialiser le questionId
    $_SESSION['questionId'] = 1;
    // initialiser le tableau de réponses
    $_SESSION['userAnswers'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ajouter la réponse de l'utilisateur au tableau
    $userAnswer = $_POST['answer'];
    array_push($_SESSION['userAnswers'], $userAnswer);

    // passer à la question suivante
    $_SESSION['questionId']++;
}

$questionId = $_SESSION['questionId'];
$question = $ds->getQuestion($questionId);

if (!$question) {
    // si on a atteint la fin des questions, rediriger vers la page results.php
    header('Location: results.php');
    exit;
}

$answers = $ds->getAnswersById($questionId);

if (isset($_POST['restart']) && $_POST['restart'] == 'true') {
    // Réinitialiser les variables de session
    unset($_SESSION['current_question']);
    unset($_SESSION['selected_answers']);
    // Rediriger vers la première question
    header('Location: ./quiz.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
</head>

<body>
    <form method="post" action="quiz.php">
        <h1><?php echo $question; ?></h1>
        <?php
        foreach ($answers as $answer) {
            echo '<label><input type="radio" name="answer" value="' . $answer . '"> ' . $answer . '</label><br>';
        }
        ?>
        <button type="submit">Valider</button>
    </form>
</body>

</html>