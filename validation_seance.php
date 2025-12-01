<?php
date_default_timezone_set('Europe/Paris');
$today = date("Y-m-d");

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

$sql = "SELECT idseance, DateSeance FROM seances WHERE DateSeance < '$today' ORDER BY DateSeance DESC";
$result = mysqli_query($connect, $sql);

?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Choisissez une séance à valider</h1>

<form action="valider_seance.php" method="POST">
    <label>Séances passées :</label>
    <select name="idseance" required>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='".$row['idseance']."'>".
                 $row['DateSeance']." (Séance ".$row['idseance'].")</option>";
        }
        ?>
    </select>

    <input type="submit" value="Valider cette séance">
</form>

</body>
</html>
