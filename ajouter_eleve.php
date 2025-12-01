<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Récapitulatif de l'inscription</h1>
<div class="page-logo">
    <img src="lion.jpg" alt="Logo Auto École">
</div>

<?php
// Récupération des infos
$civilite = $_POST["civilite"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$adresse = $_POST["adresse"];
$date_naissance = $_POST["date_naissance"];

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");

// Connexion
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Erreur connexion");
mysqli_set_charset($connect, 'utf8');

// Vérifier si élève existe
$sql = "SELECT * FROM eleves WHERE nom='$nom' AND prenom='$prenom'";
$result = mysqli_query($connect, $sql);

// Affichage récapitulatif clean
echo "<form>";

echo "<label>Civilité :</label> $civilite <br>";
echo "<label>Nom :</label> $nom <br>";
echo "<label>Prénom :</label> $prenom <br>";
echo "<label>Adresse :</label> $adresse <br>";
echo "<label>Date de naissance :</label> $date_naissance <br>";

echo "</form><br><br>";

if (mysqli_num_rows($result) == 0) {

    $query = "INSERT INTO eleves VALUES (NULL,'$nom','$prenom','$date_naissance','$date')"; // une chaine de caractere nommee $query
echo "<br> la commande qui vient d etre effectué: ".$query."<br>"; // TOUJOURS afficher la commande SQL contruite
// quand vous mettez au point vos codes
$result = mysqli_query($connect, $query); // $query utilise comme parametre de mysqli_query
if (!$result) // TOUJOURS tester le resultat de la requete
{
echo '<p> Requête invalide et voici le code erreur de mysql : '.mysqli_error($connect) . "</p> ";

}





} else {

    // Demande confirmation
    echo "<h2 style='color:red;'>⚠ Cet élève existe déjà !</h2>";
    echo "<p>Voulez-vous l'ajouter quand même ?</p>";

    echo "<form action='valider_eleve.php' method='POST'>";

    echo "<input type='hidden' name='civilite' value='$civilite'>";
    echo "<input type='hidden' name='nom' value='$nom'>";
    echo "<input type='hidden' name='prenom' value='$prenom'>";
    echo "<input type='hidden' name='adresse' value='$adresse'>";
    echo "<input type='hidden' name='date_naissance' value='$date_naissance'>";

    echo "<div class='radio-group'>";
    echo "<div class='radio-option'><input type='radio' name='sur' value='oui' required><label>OUI: </label></div>";
    echo "<div class='radio-option'><input type='radio' name='sur' value='non'><label>NON: </label></div>";
    echo "</div>";

    echo "<input type='submit' value='Confirmer'>";
    echo "</form>";
}

mysqli_close($connect);
?>

</body>
</html>
