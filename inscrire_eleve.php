<?php
$ideleve = $_POST['ideleve'];
$idseance = $_POST['idseance'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

echo "<h1>Résultat de l’inscription</h1>";

/* 1 — Vérifier l’effectif maximum */
$sql1 = "SELECT EffMax FROM seances WHERE idseance='$idseance'";
$res1 = mysqli_query($connect, $sql1);
$ligne = mysqli_fetch_array($res1);
$effmax = $ligne['EffMax'];

/* Nombre d’élèves déjà inscrits */
$sql2 = "SELECT COUNT(*) FROM inscription WHERE idseance='$idseance'";
$res2 = mysqli_query($connect, $sql2);
$nb = mysqli_fetch_array($res2)[0];

if ($nb >= $effmax) {
    echo "<p>⚠ La séance est complète : $nb / $effmax inscrits</p>";
    echo "<input type='button' value='Retour' onclick=\"window.location='inscription_eleve.php'\">";
    exit;
}

/* 2 — Vérifier si l’élève est déjà inscrit */
$sql3 = "SELECT * FROM inscription 
         WHERE ideleve='$ideleve' AND idseance='$idseance'";
$res3 = mysqli_query($connect, $sql3);

if (mysqli_num_rows($res3) > 0) {
    echo "<p>⚠ Cet élève est déjà inscrit à cette séance !</p>";
    echo "<input type='button' value='Retour' onclick=\"window.location='inscription_eleve.php'\">";
    exit;
}

/* 3 — Inscrire l’élève */
$sql4 = "INSERT INTO inscription (idseance, ideleve, note)
         VALUES ('$idseance', '$ideleve', NULL)";

$res4 = mysqli_query($connect, $sql4);

if (!$res4) {
    echo "<p>Erreur SQL : ".mysqli_error($connect)."</p>";
    exit;
}

echo "<p>✔ Élève inscrit avec succès !</p>";
echo "<input type='button' value='Retour' onclick=\"window.location='inscription_eleve.php'\">";
echo "<input type='button' value='Accueil' onclick=\"window.location='accueil.html'\">";

mysqli_close($connect);
?>
