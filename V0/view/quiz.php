<?php

require_once '../lib/DataSource.php';

use Phppot\DataSource;

$ds = new DataSource();

$questionId = isset($_POST['questionId']) ? $_POST['questionId'] : 2;

if (isset($_POST['submit'])) {
    $questionId++;
}

$question = $ds->getQuestion($questionId);

echo $question;
echo '<br />';

$answers = $ds->getAnswersById($questionId);

// afficher les réponses
foreach ($answers as $answer) {
    echo $answer . '<br>';
}
?>
<form method="POST">
    <input type="hidden" name="questionId" value="<?php echo $questionId; ?>">
    <button type="submit" name="submit">VALIDER</button>
</form>
