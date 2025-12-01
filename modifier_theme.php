<?php
// modifier_theme.php

if (!isset($_GET['id'])) {
    echo "<p>Identifiant du thème manquant.</p>";
    exit;
}

$idtheme = intval($_GET['id']);

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

// Récupération des infos du thème
$sql = "SELECT * FROM themes WHERE idtheme='$idtheme'";
$res = mysqli_query($connect, $sql);

if (!$res || mysqli_num_rows($res) == 0) {
    echo "<p>Thème introuvable.</p>";
    exit;
}

$theme = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Modifier un thème</title>
</head>

<body>

<h1>Modifier le thème</h1>

<div class="page-container">

<form action="update_theme.php" method="POST">

    <input type="hidden" name="idtheme" value="<?php echo $theme['idtheme']; ?>">

    <label>Nom du thème :</label>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($theme['nom']); ?>" required>

    <label>Descriptif :</label>
    <textarea name="descriptif" rows="5"><?php echo htmlspecialchars($theme['descriptif']); ?></textarea>

    <input type="submit" value="Mettre à jour">
</form>

</div>

</body>
</html>

<?php mysqli_close($connect); ?>
