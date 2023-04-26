<?php
require_once '../lib/DataSource.php';

use Phppot\DataSource;

session_start();

$ds = new DataSource();

$userAnswers = $_SESSION['userAnswers'];
$totalQuestions = $ds->getTotalQuestions();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Quiz Results</title>
</head>

<body>
    <h1>Réponses</h1>

    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Réponse choisie</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= $totalQuestions; $i++) { ?>
                <tr>
                    <td><?php echo $ds->getQuestion($i); ?></td>
                    <td><?php echo isset($userAnswers[$i]) ? $userAnswers[$i] : 'Aucune réponse choisie'; ?></td>
                </tr>
            <?php } ?>
            <form action="quiz.php" method="post">
                <input type="hidden" name="restart" value="true">
                <button type="submit">Recommencer le test</button>
            </form>

        </tbody>
    </table>

</body>

</html>