<?php
// liste_eleves.php
$dbhost = 'tuxa.sme.utc'; $dbuser='nf92a040'; $dbpass='JXQvDFj2eA8t'; $dbname='nf92a040';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); mysqli_set_charset($connect,'utf8');

$sql = "SELECT ideleve, nom, prenom, datNaiss, dateInscription FROM eleves ORDER BY nom, prenom";
$res = mysqli_query($connect, $sql);
?>
<!doctype html><html><head><meta charset="utf-8"><link rel="stylesheet" href="style.css"></head><body>
<h1>Liste des élèves</h1>
<div class="page-container">
<?php if(mysqli_num_rows($res)==0){ echo "<p>Aucun élève.</p>"; }
else {
  echo "<table style='width:100%'><tr><th>Nom</th><th>Naissance</th><th>Inscription</th><th>Actions</th></tr>";
  while($r=mysqli_fetch_assoc($res)){
    echo "<tr><td>{$r['nom']} {$r['prenom']}</td>
          <td>{$r['datNaiss']}</td>
          <td>{$r['dateInscription']}</td>
          <td><a href='modifier_eleve.php?id={$r['ideleve']}'>Modifier</a> | 
              <a href='supprimer_eleve.php?id={$r['ideleve']}'>Supprimer</a></td></tr>";
  }
  echo "</table>";
}
?>
<p><a class="button" href="ajout_eleve.html">Ajouter un élève</a></p>
</div></body></html>
<?php mysqli_close($connect); ?>
