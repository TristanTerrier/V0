<?php
/* $id = mysqli_connect("localhost", "root", "", "nextutdp_bdd") or die("Erreur de connexion");
$res = mysqli_query($id, "SELECT * FROM tdp_questions");
$tab = mysqli_fetch_assoc($res);
echo $tab["question_id"] . ') ' . implode(' ', ["quiz_question"]);
echo "<br />"; */

require_once('../lib/DataSource.php');

use Phppot\DataSource;

$db = new DataSource();
$string = $db->getSingleValue("SELECT value FROM tdp_questions WHERE id = 3", "i", array(3));
echo $string;
