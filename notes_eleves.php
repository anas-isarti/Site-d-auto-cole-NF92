<?php
// Vérifier que des notes ont été envoyées
if (!isset($_POST['note'])) {
    echo "<h1>Aucune note reçue</h1>";
    echo "<p>Aucun élève n’était inscrit OU aucun champ note[] n’a été généré.</p>";
    echo "<input type='button' value='Retour' onclick=\"window.history.back()\">";
    exit;
}

$idseance = $_POST['idseance'];
$notes = $_POST['note'];

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connect, 'utf8');

echo "<h1>Résultat de l'enregistrement</h1>";

foreach ($notes as $ideleve => $note) {

    if ($note === "" || $note === null) {
        // note vide → NULL
        $sql = "UPDATE inscription 
                SET note = NULL
                WHERE idseance='$idseance' 
                AND ideleve='$ideleve'";
    } 
    else {
        // Sécuriser la note
        $note = intval($note);
        if ($note < 0) $note = 0;
        if ($note > 40) $note = 40;

        $sql = "UPDATE inscription 
                SET note='$note'
                WHERE idseance='$idseance' 
                AND ideleve='$ideleve'";
    }

    echo "Commande SQL : $sql <br>";
    mysqli_query($connect, $sql);
}

echo "<br><b>Notes enregistrées avec succès !</b><br><br>";

echo "<input type='button' value='Accueil' onclick=\"window.location='accueil.html'\"> ";
echo "<input type='button' value='Valider une séance' onclick=\"window.location='validation_seance.php'\">";

mysqli_close($connect);
?>
