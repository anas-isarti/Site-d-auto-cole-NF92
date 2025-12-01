<?php
if(!isset($_GET['id'])){ echo "Id manquant."; exit; }
$id = intval($_GET['id']);
$dbhost='tuxa.sme.utc'; $dbuser='nf92a040'; $dbpass='JXQvDFj2eA8t'; $dbname='nf92a040';
$connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); mysqli_set_charset($connect,'utf8');

$sql = "SELECT * FROM eleves WHERE ideleve='$id'"; $res=mysqli_query($connect,$sql);
if(!$res || mysqli_num_rows($res)==0){ echo "Élève introuvable."; exit; }
$r = mysqli_fetch_assoc($res);
?>
<!doctype html><html><head><meta charset="utf-8"><link rel="stylesheet" href="style.css"></head><body>
<h1>Modifier élève</h1>
<div class="page-container">
<form action="update_eleve.php" method="POST">
  <input type="hidden" name="ideleve" value="<?php echo $r['ideleve']; ?>">
  <label>Nom</label><input type="text" name="nom" value="<?php echo htmlspecialchars($r['nom']); ?>" required>
  <label>Prénom</label><input type="text" name="prenom" value="<?php echo htmlspecialchars($r['prenom']); ?>" required>
  <label>Date naissance</label><input type="date" name="datNaiss" value="<?php echo $r['datNaiss']; ?>">
  <label>Date inscription</label><input type="date" name="dateInscription" value="<?php echo $r['dateInscription']; ?>">
  <input type="submit" value="Mettre à jour">
</form>
</div></body></html>
<?php mysqli_close($connect); ?>
