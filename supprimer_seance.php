<?php
$id = $_GET['id'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Supprimer inscriptions
mysqli_query($connect, "DELETE FROM inscription WHERE idseance='$id'");

// Supprimer séance
mysqli_query($connect, "DELETE FROM seances WHERE idseance='$id'");

echo "<h1>Séance supprimée</h1>";
echo "<a class='button' href='liste_seances.php'>Retour aux séances</a>";
?>
