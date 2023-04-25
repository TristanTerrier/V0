<?php
/* $id = mysqli_connect("localhost", "root", "", "nextutdp_bdd") or die("Erreur de connexion");
$res = mysqli_query($id, "SELECT * FROM tdp_questions");
$tab = mysqli_fetch_assoc($res);
echo $tab["question_id"] . ') ' . implode(' ', ["quiz_question"]);
echo "<br />"; */

require_once '../lib/DataSource.php';

use Phppot\DataSource;

$ds = new DataSource();

$questionId = 1;
$question = $ds->getQuestion($questionId);

echo $question;
echo '<br />';

$answers = $ds->getAnswersById(1);

// afficher les réponses
foreach ($answers as $answer) {
    echo $answer . '<br>';
}
