<?php

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$date_naissance = $_POST["date_naissance"];
$sur = $_POST["sur"];

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");  // date d'inscription

if ($sur == "non") {
    echo "<h1>Ajout annulé</h1>";
    echo "L'élève n'a pas été ajouté.";
    exit();
}

echo "<h1>Ajout confirmé</h1>";
echo "Ajout de l'élève : $nom $prenom <br><br>";

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040';
$dbpass = 'JXQvDFj2eA8t';
$dbname = 'nf92a040';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Erreur connexion");
mysqli_set_charset($connect, 'utf8');

$query = "INSERT INTO eleves VALUES (NULL,'$nom','$prenom','$date_naissance','$date')"; // une chaine de caractere nommee $query
echo "<br> la commande qui vient d etre effectué: ".$query."<br>"; // TOUJOURS afficher la commande SQL contruite
// quand vous mettez au point vos codes
$result = mysqli_query($connect, $query); // $query utilise comme parametre de mysqli_query
if (!$result) // TOUJOURS tester le resultat de la requete
{
echo '<p> Requête invalide et voici le code erreur de mysql : '.mysqli_error($connect) . "</p> ";

}


mysqli_close($connect);
?>



