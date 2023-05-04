<html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style_homepa.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">



    <?php


$query = $pdo->prepare("SELECT * FROM quiz");
$query->execute();
$quizzes = $query->fetchAll(PDO::FETCH_ASSOC);

// Boucle pour générer une carte HTML pour chaque quiz
foreach ($quizzes as $quiz) {
    echo '<div class="col">';
    echo '<div class="card" style="width: 18rem;">';
    echo '<img src="'.$quiz['quizz_picture'].'" class="card-img-top" alt="...">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">'.$quiz['quiz_name'].'</h5>';
    echo '<p class="card-text">'.$quiz['quiz_description'].'</p>';
    echo '<a href="/quiz.php?id='.$quiz['id'].'" class="btn btn-primary">Faire le quiz</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>


        <div class="container-fluid">
            <br />
            <div class="row">

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="../assets/img/test.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">test de positionnement</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="./quiz.php" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

            </div>

            <br /><br />
            <div class="row">

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

            </div>
            <br /><br />
            <div class="row">

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">make test</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://e7.pngegg.com/pngimages/750/157/png-clipart-test-computer-icons-grade-five-education-testing-icon-blue-text.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

</body>

</html>