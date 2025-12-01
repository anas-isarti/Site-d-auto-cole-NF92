<?php
// supprimer_theme.php
if (!isset($_POST['idtheme'])) {
    echo "Requête invalide.";
    exit;
}
$idtheme = intval($_POST['idtheme']);

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
mysqli_set_charset($connect, 'utf8');

// Vérifier qu'il n'y a pas de séance liée
$q = "SELECT COUNT(*) AS nb FROM seances WHERE idtheme='$idtheme'";
$r = mysqli_query($connect, $q);
$nb = mysqli_fetch_assoc($r)['nb'];

if ($nb > 0) {
    echo "<h1>Suppression impossible</h1>";
    echo "<p>Ce thème possède $nb séance(s) associée(s). Supprimez d'abord ces séances.</p>";
    echo "<p><a href='liste_seances.php'>Voir les séances</a></p>";
    exit;
}

// Effectuer suppression logique
$upd = "UPDATE themes SET supprime = 1 WHERE idtheme = '$idtheme'";
$res = mysqli_query($connect, $upd);
if (!$res) {
    echo "<p>Erreur SQL : ".mysqli_error($connect)."</p>";
    exit;
}

echo "<h1>Thème supprimé (logique)</h1>";
echo "<p>Le thème a été marqué comme supprimé et n'apparaîtra plus dans les formulaires.</p>";
echo "<p><a href='liste_themes.php'>Retour à la liste des thèmes</a></p>";

mysqli_close($connect);
?>
