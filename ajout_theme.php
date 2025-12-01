<?php
echo "<h1> Recapitulatif:   </h1>";

$nom=$_POST['nom'];
$descriptif=$_POST['descriptif'];




echo "Bonjour, Vous trouverez si joint le récapitulatif :   <br> " . $nom." <br>  " . $descriptif ;




$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a040'; 
$dbpass = 'JXQvDFj2eA8t'; 
$dbname = 'nf92a040'; 
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

if ($connect==false){
    echo "<p> La connection a échoué </p>";
    
} else {
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
// vos commandes au serveur de BDD sont à ajouter ici
}





$query = "INSERT INTO themes VALUES (NULL,'$nom',FALSE,'$descriptif')"; // une chaine de caractere nommee $query
echo "<br> la commande qui vient d etre effectué: ".$query."<br>"; // TOUJOURS afficher la commande SQL contruite
// quand vous mettez au point vos codes
$result = mysqli_query($connect, $query); // $query utilise comme parametre de mysqli_query
if (!$result) // TOUJOURS tester le resultat de la requete
{
echo '<p> Requête invalide et voici le code erreur de mysql : '.mysqli_error($connect) . "</p> ";

}


mysqli_close($connect);


?>
