

<?php

$idtheme = $_POST['idtheme'];
$date_seance = $_POST['date_seance'];
$effmax = $_POST['effmax'];

echo "<h1>Récapitulatif de la séance</h1>";
echo "Thème : $idtheme <br>";
echo "Date : $date_seance <br>";
echo "Effectif maximum : $effmax <br><br>";

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Erreur connexion");
mysqli_set_charset($connect, 'utf8');

// Vérifier doublon séance même jour / même thème
$check = "SELECT * FROM seances WHERE DateSeance = '$date_seance' AND idtheme = '$idtheme'";
$result_check = mysqli_query($connect, $check);

if (mysqli_num_rows($result_check) > 0) {
    echo "<h2 style='color:red;'>⚠ Une séance existe déjà pour ce thème à cette date.</h2>";
    echo "<p>Veuillez choisir une autre date.</p>";
    mysqli_close($connect);
    exit();
}

// Insérer la nouvelle séance
$query = "INSERT INTO seances VALUES (NULL, '$date_seance', '$effmax', '$idtheme')";
echo "Commande SQL : $query <br>";

$result = mysqli_query($connect, $query);

if (!$result) {
    echo "<p>Erreur SQL : " . mysqli_error($connect) . "</p>";
} else {
    echo "<h2 style='color:green;'>Séance ajoutée avec succès.</h2>";
}

mysqli_close($connect);

?>
