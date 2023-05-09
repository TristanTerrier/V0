
<?php
if (isset($_GET['id'])) {
    $quizId = $_GET['id'];
    $conn = mysqli_connect('localhost', 'root', 'root', 'nextutdp_bdd');
    if (!$conn) {
        die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['answer'])) {
            $questionId = $_POST['question_id'];
            $answerId = $_POST['answer'];
            $insertQuery = "INSERT INTO quiz_responses (quiz_id, question_id, answer_id) VALUES ('$quizId', '$questionId', '$answerId')";
            mysqli_query($conn, $insertQuery);
            $totalQuestions = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tdp_questions WHERE quiz_id = $quizId"));
            if ($questionId >= $totalQuestions) {
                $scoreQuery = "SELECT SUM(answer_score) AS total_score FROM tdp_score
                               WHERE answer_id IN (
                                   SELECT answer_id FROM quiz_responses WHERE quiz_id = $quizId
                               )";
                $scoreResult = mysqli_query($conn, $scoreQuery);
                $scoreData = mysqli_fetch_assoc($scoreResult);
                $totalScore = $scoreData['total_score'];
                $resultsQuery = "SELECT tdp_results_grid.categories_id, tdp_results_grid.results, tdp_categories.categories_name
                                 FROM tdp_results_grid
                                 INNER JOIN tdp_categories ON tdp_results_grid.categories_id = tdp_categories.categories_id
                                 WHERE tdp_results_grid.points <= $totalScore
                                 ORDER BY tdp_results_grid.points DESC";
                $resultsResult = mysqli_query($conn, $resultsQuery);
                $categoryResults = array();
                while ($row = mysqli_fetch_assoc($resultsResult)) {
                    $categoryId = $row['categories_id'];
                    $result = $row['results'];
                    $categoryName = $row['categories_name'];

                    $categoryResults[$categoryName] = $result;
                }

                echo "<h3>Résultats :</h3>";
                /*echo "Score total : $totalScore<br>";*/

                foreach ($categoryResults as $categoryName => $result) {
                    echo "Résultat dans la catégorie $categoryName : $result<br><br>";
                }

                exit();
            } else {
                header("Location: quiz.php?id=$quizId&question=" . ($questionId + 1));
                exit();
            }
        } else {
            echo "Erreur: Aucune réponse sélectionnée.";
        }
    }

    $questionNumber = isset($_GET['question']) ? $_GET['question'] : 1;
    $questionQuery = "SELECT * FROM tdp_questions WHERE quiz_id = $quizId AND question_id = $questionNumber";
    $questionResult = mysqli_query($conn, $questionQuery);
    if ($questionResult && mysqli_num_rows($questionResult) > 0) {
        $questionData = mysqli_fetch_assoc($questionResult);
        $questionId = $questionData['question_id'];
        $questionText = $questionData['quiz_question'];
        $answerQuery = "SELECT * FROM tdp_answers WHERE question_id = $questionId";
        $answerResult = mysqli_query($conn, $answerQuery);

        echo "<!DOCTYPE html>";
        echo "<html lang='fr'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<title>Quiz</title>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "</head>";
        echo "<body>";
        echo "<h3>Question $questionNumber :</h3>";
        echo "<p>$questionText</p>";
        echo "<form method='POST' action='quiz.php?id=$quizId'>";
        echo "<input type='hidden' name='question_id' value='$questionId'>";

        while ($answerData = mysqli_fetch_assoc($answerResult)) {
            $answerId = $answerData['answer_id'];
            $answerText = $answerData['answer'];

            echo "<label>";
            echo "<input type='radio' name='answer' value='$answerId' required>";
            echo $answerText;
            echo "</label><br>";
        }

        echo "<br>";
        echo "<button type='submit'>Suivant</button>";
        echo "</form>";
        echo "</body>";
        echo "</html>";

        mysqli_close($conn);
    } else {
        echo "Question introuvable.";
    }
} else {
    echo "ID de quiz non spécifié.";
}
?>
