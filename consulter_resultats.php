<?php
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

$sql = "SELECT ideleve, nom, prenom FROM eleves ORDER BY nom, prenom";
$result = mysqli_query($connect, $sql);
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Consulter les résultats d'un élève</h1>

<form action="resultats_eleve.php" method="POST">

<label>Choisissez un élève :</label>
<select name="ideleve" required>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['ideleve']."'>".$row['nom']." ".$row['prenom']."</option>";
    }
    ?>
</select>

<input type="submit" value="Voir les résultats">

</form>

</body>
</html>
