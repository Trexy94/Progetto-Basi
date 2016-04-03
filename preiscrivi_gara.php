<?php
session_start();
require 'connect.php';
connect();
	// recupero i campi di tipo "stringa"
	$allievo      = trim($_POST['allievo']);
	$ubicazione    = trim($_POST['ubicazione_gara']);
	$datagara = $_POST['datagara']." ".$_POST['oragara'];
        $disciplina=$_POST['discipline'];

	// verifico se devo eliminare gli slash inseriti automaticamente da PHP
	if(get_magic_quotes_gpc())
	{
		$allievo      = stripslashes($allievo);
		$ubicazione    = stripslashes($ubicazione);
                
	}

                $allievo      = mysql_real_escape_string($allievo);
                $ubicazione = mysql_real_escape_string($ubicazione);
                
$sql="SELECT * FROM palestra.agonisti WHERE Disciplina='$disciplina' and Allievo='$allievo'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if ($count!=1)
{
    echo 'nessun allievo agonista trovato, tornerai indietro tra 3 secondi';
    header('Refresh: 3; URL=preiscrizione_gara.php');
    die;
}
    // preparo la query
	$query = "INSERT INTO `palestra`.`preiscrizioni` (`Allievo`, `UbicazioneGara`, `GiornoGara`, `Disciplina`) VALUES ('$allievo', '$ubicazione', '$datagara', '$disciplina');";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
                echo"registrazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=aggiungi_gara.php');
                die("Errore nella query $query: " . mysql_error());
	}
    
	echo("Inserimento effettuato con successo");
	header('Refresh: 3; URL=Homemaestro.php');
?>