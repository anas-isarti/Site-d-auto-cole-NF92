<?php
$dbhost='tuxa.sme.utc'; $dbuser='nf92a040'; $dbpass='JXQvDFj2eA8t'; $dbname='nf92a040';
$connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); mysqli_set_charset($connect,'utf8');

// total élèves
$total_e = mysqli_fetch_array(mysqli_query($connect,"SELECT COUNT(*) FROM eleves"))[0];
// total séances
$total_s = mysqli_fetch_array(mysqli_query($connect,"SELECT COUNT(*) FROM seances"))[0];
// moyenne générale (toutes notes non nulles)
$moy = mysqli_fetch_assoc(mysqli_query($connect,"SELECT AVG(note) AS m FROM inscription WHERE note IS NOT NULL"))['m'];

// top 5 élèves par moyenne
$best = mysqli_query($connect, "SELECT e.ideleve, e.nom, e.prenom, AVG(i.note) AS moyenne
                                FROM eleves e JOIN inscription i ON e.ideleve=i.ideleve
                                WHERE i.note IS NOT NULL
                                GROUP BY e.ideleve
                                ORDER BY moyenne DESC LIMIT 5");
?>
<!doctype html><html><head><meta charset="utf-8"><link rel="stylesheet" href="style.css"></head><body>
<h1>Statistiques</h1>
<div class="page-container">
<p>Total élèves : <?php echo $total_e; ?></p>
<p>Total séances : <?php echo $total_s; ?></p>
<p>Moyenne générale (toutes notes) : <?php echo ($moy!==null?round($moy,2):'Pas encore de notes'); ?></p>

<h2>Top 5 élèves (moyenne)</h2>
<table><tr><th>Élève</th><th>Moyenne</th></tr>
<?php while($b=mysqli_fetch_assoc($best)){ echo "<tr><td>{$b['nom']} {$b['prenom']}</td><td>".round($b['moyenne'],2)."</td></tr>"; } ?>
</table>
</div></body></html>
<?php mysqli_close($connect); ?>
