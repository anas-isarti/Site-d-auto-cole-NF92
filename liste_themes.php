<?php
// liste_themes.php
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
mysqli_set_charset($connect, 'utf8');

$sql = "SELECT idtheme, nom, descriptif, supprime FROM themes ORDER BY nom";
$res = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Liste des thèmes</title>
</head>
<body>
  <h1>Liste des thèmes</h1>
  <div class="page-container">
    <?php if (mysqli_num_rows($res) == 0): ?>
      <p>Aucun thème trouvé.</p>
    <?php else: ?>
      <table style="width:100%; border-collapse:collapse;">
        <tr style="background:#eee;">
          <th style="padding:8px; text-align:left;">Nom</th>
          <th style="padding:8px; text-align:left;">Descriptif</th>
          <th style="padding:8px;">État</th>
          <th style="padding:8px;">Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($res)): ?>
          <tr>
            <td style="padding:8px;"><?php echo htmlspecialchars($row['nom']); ?></td>
            <td style="padding:8px;"><?php echo nl2br(htmlspecialchars($row['descriptif'])); ?></td>
            <td style="padding:8px;">
              <?php if ($row['supprime']): ?>
                <span style="color:darkred;font-weight:bold;">Supprimé</span>
              <?php else: ?>
                <span style="color:green;">Actif</span>
              <?php endif; ?>
            </td>
            <td style="padding:8px; text-align:center;">
              <a href="modifier_theme.php?id=<?php echo $row['idtheme']; ?>">Modifier</a>
              &nbsp;|&nbsp;
              <?php if ($row['supprime']): ?>
                <span style="color:#777;">Supprimé</span>
              <?php else: ?>
                <a href="confirmer_suppression_theme.php?id=<?php echo $row['idtheme']; ?>">Supprimer</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php endif; ?>

    <p style="margin-top:14px;">
      <a class="button" href="ajout_theme.html">Ajouter un thème</a>
    </p>
  </div>
</body>
</html>
<?php mysqli_close($connect); ?>
