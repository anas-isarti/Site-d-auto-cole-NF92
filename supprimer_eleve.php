<?php
if(!isset($_GET['id'])){ echo "Id manquant."; exit; }
$id=intval($_GET['id']);
$dbhost='tuxa.sme.utc'; $dbuser='nf92a040'; $dbpass='JXQvDFj2eA8t'; $dbname='nf92a040';
$connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); mysqli_set_charset($connect,'utf8');

// vérifier si inscrit à des séances
$q = "SELECT COUNT(*) AS nb FROM inscription WHERE ideleve='$id'"; $r = mysqli_query($connect,$q);
$nb = mysqli_fetch_assoc($r)['nb'];
if($nb>0){
  echo "<h1>Suppression impossible</h1><p>L'élève est inscrit à $nb séance(s). Supprimez d'abord les inscriptions.</p>";
  echo "<p><a href='liste_eleves.php'>Retour</a></p>";
  exit;
}
// sinon supprimer
mysqli_query($connect,"DELETE FROM eleves WHERE ideleve='$id'");
echo "<h1>Élève supprimé</h1><p><a href='liste_eleves.php'>Retour</a></p>";
mysqli_close($connect);
?>
