<?php
$id = $_GET['id'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Récupérer séance
$sql = "SELECT * FROM seances WHERE idseance='$id'";
$res = mysqli_query($connect, $sql);
$seance = mysqli_fetch_assoc($res);

// Récupérer thèmes
$sql2 = "SELECT idtheme, nom FROM themes WHERE supprime = FALSE";
$res2 = mysqli_query($connect, $sql2);
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Modifier la séance</h1>

<form action="modifier_seance_action.php" method="POST">
    <input type="hidden" name="idseance" value="<?php echo $id; ?>">

    <label>Changer le thème :</label>
    <select name="idtheme" required>
        <?php
        while ($row = mysqli_fetch_assoc($res2)) {
            $selected = ($row['idtheme'] == $seance['idtheme']) ? "selected" : "";
            echo "<option value='".$row['idtheme']."' $selected>".$row['nom']."</option>";
        }
        ?>
    </select>

    <label>Changer la date :</label>
    <input type="date" name="dateseance" value="<?php echo $seance['DateSeance']; ?>" required>

    <input type="submit" value="Modifier">
</form>

</body>
</html>
