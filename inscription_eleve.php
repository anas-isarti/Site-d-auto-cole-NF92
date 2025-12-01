<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Inscription d’un élève à une séance</h1>

<div class="page-logo">
    <img src="lion.jpg" alt="Logo Auto École">
</div>

<div class="page-container">

<form action="inscrire_eleve.php" method="POST">

    <!-- CHOIX DE L'ÉLÈVE -->
    <label>Choisir un élève :</label>
    <select name="ideleve" required>
        <?php
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a040';
        $dbpass = 'JXQvDFj2eA8t';
        $dbname = 'nf92a040';

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        mysqli_set_charset($connect, 'utf8');

        $sql = "SELECT ideleve, nom, prenom FROM eleves ORDER BY nom, prenom";
        $res = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_array($res)) {
            echo "<option value='".$row['ideleve']."'>".$row['nom']." ".$row['prenom']."</option>";
        }
        ?>
    </select>

    <!-- CHOIX DE LA SÉANCE -->
    <label>Séance :</label>
    <select name="idseance" required>
        <?php
        $sql2 = "SELECT idseance, DateSeance FROM seances ORDER BY DateSeance";
        $res2 = mysqli_query($connect, $sql2);

        while ($row2 = mysqli_fetch_array($res2)) {
            echo "<option value='".$row2['idseance']."'>".$row2['DateSeance']." (Séance ".$row2['idseance'].")</option>";
        }
        ?>
    </select>

    <input type="submit" value="Inscrire l’élève">

</form>

</div>

</body>
</html>
