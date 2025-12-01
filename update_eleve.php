<?php
if(!isset($_POST['ideleve'])){ echo "Requête invalide."; exit; }
$ideleve = intval($_POST['ideleve']);
$nom = $_POST['nom']; $prenom = $_POST['prenom'];
$datNaiss = $_POST['datNaiss']; $dateIns = $_POST['dateInscription'];

$dbhost='tuxa.sme.utc'; $dbuser='nf92a040'; $dbpass='JXQvDFj2eA8t'; $dbname='nf92a040';
$connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); mysqli_set_charset($connect,'utf8');

$sql = "UPDATE eleves SET nom='$nom', prenom='$prenom', datNaiss='$datNaiss', dateInscription='$dateIns' WHERE ideleve='$ideleve'";
$res = mysqli_query($connect,$sql);
if(!$res){ echo "Erreur SQL: ".mysqli_error($connect); exit;}
echo "<h1>Élève modifié</h1><p><a href='liste_eleves.php'>Retour</a></p>";
mysqli_close($connect);
?>
