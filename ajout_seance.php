<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="page-logo">
    <img src="lion.jpg" alt="Logo Auto École">
</div>

<h1>Créer une nouvelle séance</h1>

<?php
// Connexion BDD
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to MySQL');
mysqli_set_charset($connect, 'utf8');

// On récupère les thèmes actifs (supprime = FALSE)
$query = "SELECT idtheme, nom FROM themes WHERE supprime = 0";
$result = mysqli_query($connect, $query);

if (!$result) {
    echo "<p>Erreur SQL : " . mysqli_error($connect) . "</p>";
    exit();
}

echo "<form action='ajouter_seance.php' method='POST'>";

echo "<label>Choisissez un thème :</label>";
echo "<select name='idtheme' required>";

while ($row = mysqli_fetch_array($result)) {
    echo "<option value='".$row[0]."'>".$row[1]."</option>";
}

echo "</select>";
?>

<br><br>

<label>Date de la séance :</label>
<input type="date" name="date_seance" required>

<label>Effectif maximum :</label>
<input type="number" name="effmax" min="1" required>

<input type="submit" value="Valider">

</form>

</body>
</html>
