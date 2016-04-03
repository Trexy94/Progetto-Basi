<?php
session_start();
require 'connect.php';
connect();
$agonista=mysql_real_escape_string($_POST['CodAg']);
$tipo=mysql_real_escape_string($_POST['discipline']);
$sql="SELECT * FROM palestra.non_agonisti WHERE Disciplina='$tipo' and Allievo='$agonista'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if ($count!=1)
{
    echo 'nessun allievo non agonista corrispondente trovato, tornerai indietro tra 3 secondi';
    header('Refresh: 3; URL=agonista.php');
    die;
}
else
{

    // preparo la query
	$query = "INSERT INTO Palestra.Agonisti (Disciplina,allievo)
			  VALUES ('$tipo','$agonista')";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
                echo"inserimento non riuscito, sarai reindirizzato alla home tra 3 secondi";
                header('Refresh: 3; URL=Homemaestro.php');
                die("Errore nella query $query: " . mysql_error());
	}
        
$query = "DELETE FROM Palestra.non_agonisti WHERE Disciplina='$tipo' and Allievo='$agonista'";

// invio la query
$result = mysql_query($query);

// controllo l'esito
if (!$result) {
	die("Errore nella query $query: " . mysql_error());
}
echo"operazioni completate con successo, l'utente &egrave ora agonista in $tipo";
header('Refresh: 3; URL=agonista.php');
}
?>