<?php
// update_theme.php

if (!isset($_POST['idtheme']) || !isset($_POST['nom'])) {
    echo "Requête invalide.";
    exit;
}

$idtheme = intval($_POST['idtheme']);
$nom = $_POST['nom'];
$descriptif = $_POST['descriptif'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

$sql = "UPDATE themes SET nom='$nom', descriptif='$descriptif'
        WHERE idtheme='$idtheme'";

$res = mysqli_query($connect, $sql);

if (!$res) {
    echo "<p>Erreur SQL : ".mysqli_error($connect)."</p>";
    exit;
}

echo "<h1>Thème mis à jour avec succès</h1>";
echo "<p><a href='liste_themes.php'>Retour à la liste des thèmes</a></p>";

mysqli_close($connect);
?>
