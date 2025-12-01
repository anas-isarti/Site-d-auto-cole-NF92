<?php
$ideleve = $_POST['ideleve'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Infos élève
$sql1 = "SELECT nom, prenom, dateInscription, datNaiss 
         FROM eleves WHERE ideleve='$ideleve'";
$res1 = mysqli_query($connect, $sql1);
$eleve = mysqli_fetch_assoc($res1);

// Ses résultats
$sql2 = "SELECT seances.DateSeance, inscription.note
         FROM inscription, seances
         WHERE inscription.idseance = seances.idseance
         AND inscription.ideleve = '$ideleve'
         ORDER BY seances.DateSeance ASC";

$res2 = mysqli_query($connect, $sql2);

// Moyenne
$sql3 = "SELECT AVG(note) AS moyenne
         FROM inscription
         WHERE ideleve='$ideleve' AND note IS NOT NULL";

$res3 = mysqli_query($connect, $sql3);
$moyenne = mysqli_fetch_assoc($res3)['moyenne'];
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Résultats de <?php echo $eleve['nom']." ".$eleve['prenom']; ?></h1>

<div class="page-container">

<p><b>Date de naissance :</b> <?php echo $eleve['datNaiss']; ?></p>
<p><b>Date d'inscription :</b> <?php echo $eleve['dateInscription']; ?></p>

<h2>Historique des séances</h2>

<table border="1" style="width:100%; margin-top:20px;">
    <tr>
        <th>Date de la séance</th>
        <th>Note / 40</th>
    </tr>

<?php
$compteur = 0;

while ($row = mysqli_fetch_assoc($res2)) {
    echo "<tr>";
    echo "<td>".$row['DateSeance']."</td>";
    echo "<td>".($row['note'] !== NULL ? $row['note'] : "Non noté")."</td>";
    echo "</tr>";
    $compteur++;
}

if ($compteur == 0) {
    echo "<tr><td colspan='2'>Aucune séance suivie</td></tr>";
}
?>
</table>

<h2 style="margin-top:20px;">Moyenne générale :</h2>
<p style="font-size:20px;">
    <b>
    <?php 
        echo ($moyenne !== NULL ? round($moyenne, 2)."/40" : "Pas encore de notes");
    ?>
    </b>
</p>

<br>
<a href="consulter_resultats.php" class="button">Retour</a>

</div>

</body>
</html>
