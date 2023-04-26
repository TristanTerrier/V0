<?php

require_once '../lib/DataSource.php';

use Phppot\DataSource;

$ds = new DataSource();

$questionId = isset($_GET['id']) ? $_GET['id'] : 1;
$question = $ds->getQuestion($questionId);

if ($question === '') {
    // Si la question n'est pas trouvée dans la base de données, on redirige vers une autre page
    header('Location: ./results.php');
    exit;
}

echo $question;
echo '<br />';

$answers = $ds->getAnswersById($questionId);

// afficher les réponses
foreach ($answers as $answer) {
    echo $answer . '<br>';
}
?>
<a href="?id=<?php echo $questionId + 1; ?>"><button type="submit">VALIDER</button></a>