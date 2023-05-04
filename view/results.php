<?php
require_once '../controller/DataSource.php';

use Phppot\DataSource;

session_start();

$ds = new DataSource();

$userAnswers = $_SESSION['userAnswers'];
$totalQuestions = $ds->getTotalQuestions();

if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
    // Détruire la session
    session_destroy();
    // Rediriger vers la page home
    header('Location: home_user.php');
    exit;
}
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
        </tbody>
    </table>

    <form method="post">
        <input type="hidden" name="logout" value="true">
        <button type="submit">Terminer la session</button>
    </form>
</body>

</html>