<?php
date_default_timezone_set('Europe/Paris');
$today = date("Y-m-d");

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Séances à venir
$sql_future = "SELECT seances.idseance, seances.DateSeance, themes.nom 
               FROM seances, themes
               WHERE seances.idtheme = themes.idtheme
               AND seances.DateSeance > '$today'
               ORDER BY seances.DateSeance ASC";
$res_future = mysqli_query($connect, $sql_future);

// Séances passées
$sql_past = "SELECT seances.idseance, seances.DateSeance, themes.nom 
             FROM seances, themes
             WHERE seances.idtheme = themes.idtheme
             AND seances.DateSeance < '$today'
             ORDER BY seances.DateSeance DESC";
$res_past = mysqli_query($connect, $sql_past);
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Liste des séances</h1>

<div class="page-container">
    <h2>Séances à venir</h2>
    <?php
    if (mysqli_num_rows($res_future) == 0) {
        echo "<p>Aucune séance à venir.</p>";
    } else {
        echo "<table>";
        while ($row = mysqli_fetch_assoc($res_future)) {
            echo "<tr>";
            echo "<td>Séance du ".$row['DateSeance']." — Thème : ".$row['nom']."</td>";
            echo "<td><a href='modifier_seance.php?id=".$row['idseance']."'>Modifier</a></td>";
            echo "<td><a href='supprimer_seance.php?id=".$row['idseance']."'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>

<br>

<div class="page-container">
    <h2>Séances passées</h2>
    <?php
    if (mysqli_num_rows($res_past) == 0) {
        echo "<p>Aucune séance passée.</p>";
    } else {
        echo "<table>";
        while ($row = mysqli_fetch_assoc($res_past)) {
            echo "<tr>";
            echo "<td>Séance du ".$row['DateSeance']." — Thème : ".$row['nom']."</td>";
            echo "<td><a href='valider_seance.php?idseance=".$row['idseance']."'>Noter</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>

</body>
</html>
