<?php
session_start();
require 'connect.php';
connect();
	// recupero i campi di tipo "stringa"
	$id_corso      = trim($_POST['id_corso']);

	// verifico se devo eliminare gli slash inseriti automaticamente da PHP
	if(get_magic_quotes_gpc())
	{
		$id_corso      = stripslashes($id_corso);
                
	}

                $id_corso      = mysql_real_escape_string($id_corso);

	// recupero gli altri campi del form
$Palestra=$_POST['Palestra'];
$iniziolezione = $_POST['datalezione']." ".$_POST['ora_inizio_lezione'];
$finelezione = $_POST['datalezione']." ".$_POST['ora_fine_lezione'];


    // preparo la query
	$query = "INSERT INTO Palestra.lezione (inizio,fine,palestra,corso)
			  VALUES ('$iniziolezione','$finelezione','$Palestra','$id_corso')";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
                echo"aggiunta non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=aggiungi_lezioni.php');		
                die("Errore nella query $query: " . mysql_error());

	}
    
	echo("Inserimento effettuato con successo");
	header('Refresh: 3; URL=Homemaestro.php');
?>