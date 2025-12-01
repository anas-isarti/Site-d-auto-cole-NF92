<?php
$idseance = $_POST['idseance'];
$idtheme = $_POST['idtheme'];
$dateseance = $_POST['dateseance'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Vérifier doublon
$sql_check = "SELECT * FROM seances 
              WHERE idtheme='$idtheme' 
              AND DateSeance='$dateseance'
              AND idseance != '$idseance'";

$res = mysqli_query($connect, $sql_check);

if (mysqli_num_rows($res) > 0) {
    echo "<h1>Erreur</h1>";
    echo "<p>Il existe déjà une séance avec ce thème à cette date.</p>";
    exit;
}

$sql_update = "UPDATE seances 
               SET idtheme='$idtheme', DateSeance='$dateseance'
               WHERE idseance='$idseance'";

mysqli_query($connect, $sql_update);

echo "<h1>Modification effectuée</h1>";
echo "<a class='button' href='liste_seances.php'>Retour aux séances</a>";
?>
