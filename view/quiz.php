<?php
session_start();

require_once '../controller/DataSource.php';

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
    unset($_SESSION['questionId']);
    unset($_SESSION['userAnswers']);
    // Rediriger vers la première question
    header('Location: quiz.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Quiz</title>
</head>

<body>
    <?php include 'header_quizz.php'; ?> <br />
    <form method="post" action="quiz.php">
        <div class="container">
            <div class="row>">
                <div class="col-9">
                    <h3><?php echo $question; ?></h3>
                </div>
                <div class="col-6">
                    <?php
                    foreach ($answers as $answer) {
                        echo '<label><input class="form-check-label" type="checkbox" name="answer[]" value="' . $answer . '"> ' . $answer . '</label><br><br>';
                    }
                    ?>
                </div>

                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
</body>

</html>