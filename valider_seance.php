<?php
$idseance = $_POST['idseance'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Récupérer la séance
$sql = "SELECT DateSeance FROM seances WHERE idseance='$idseance'";
$res = mysqli_query($connect, $sql);
$seance = mysqli_fetch_array($res);

// Récupérer les élèves inscrits + leur note
$sql2 = "SELECT eleves.ideleve, eleves.nom, eleves.prenom, inscription.note
         FROM inscription, eleves
         WHERE inscription.ideleve = eleves.ideleve
         AND inscription.idseance = '$idseance'
         ORDER BY eleves.nom, eleves.prenom";

$res2 = mysqli_query($connect, $sql2);

// --- debug temporaire (à coller ici) ---
echo "<pre>DEBUG: idseance envoyé = "; var_dump($idseance);
echo "DEBUG: requête SQL2 = ". $sql2 ."\n";
echo "DEBUG: nombre de lignes trouvées = ". mysqli_num_rows($res2) ."\n";
while ($r = mysqli_fetch_assoc($res2)) { print_r($r); }
echo "</pre>";
// --- fin debug ---

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Notes de la séance du <?php echo $seance['DateSeance']; ?></h1>

<form action="notes_eleves.php" method="POST">

<input type="hidden" name="idseance" value="<?php echo $idseance; ?>">

<?php
while ($row = mysqli_fetch_assoc($res2)) {
    echo "<div class='page-container'>";
    echo "<label>".$row['nom']." ".$row['prenom']."</label>";

    echo "<input type='number' 
        name='note[".$row['ideleve']."]' 
        min='0' max='40' 
        value=\"".($row['note'] !== NULL ? $row['note'] : "")."\">";

    echo "</div>";

}
?>

<input type="submit" value="Enregistrer les notes">
</form>

</body>
</html>
