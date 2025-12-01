<?php
// confirmer_suppression_theme.php
if (!isset($_GET['id'])) {
    echo "Identifiant du thème manquant.";
    exit;
}
$idtheme = intval($_GET['id']);

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
mysqli_set_charset($connect, 'utf8');

// Récupérer infos thème
$q = "SELECT idtheme, nom, descriptif, supprime FROM themes WHERE idtheme='$idtheme'";
$r = mysqli_query($connect, $q);
if (!$r || mysqli_num_rows($r) == 0) {
    echo "<p>Thème introuvable.</p>";
    exit;
}
$theme = mysqli_fetch_assoc($r);

// Vérifier s'il existe des séances liées
$q2 = "SELECT COUNT(*) AS nb FROM seances WHERE idtheme='$idtheme'";
$r2 = mysqli_query($connect, $q2);
$nb = mysqli_fetch_assoc($r2)['nb'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Confirmer suppression</title>
</head>
<body>
  <h1>Suppression du thème : <?php echo htmlspecialchars($theme['nom']); ?></h1>

  <div class="page-container">
    <p><?php echo nl2br(htmlspecialchars($theme['descriptif'])); ?></p>

    <?php if ($nb > 0): ?>
      <p style="color:darkred; font-weight:bold;">
        Impossible de supprimer ce thème : il existe <?php echo $nb; ?> séance(s) associée(s).
      </p>
      <p>Vous devez d'abord supprimer (ou modifier) ces séances.</p>
      <p><a class="button" href="liste_seances.php">Voir les séances</a></p>
    <?php else: ?>
      <p>Ce thème ne contient aucune séance. Voulez-vous le marquer comme supprimé ?</p>

      <form action="supprimer_theme.php" method="POST">
        <input type="hidden" name="idtheme" value="<?php echo $idtheme; ?>">
        <input type="submit" value="Confirmer la suppression">
        &nbsp;
        <a href="liste_themes.php" class="button">Annuler</a>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
<?php mysqli_close($connect); ?>
