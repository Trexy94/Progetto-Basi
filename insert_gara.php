<?php
session_start();
require 'connect.php';
connect();
	// recupero i campi di tipo "stringa"
	$nome      = trim($_POST['nome']);
	$costo_trasferta    = trim($_POST['costo_trasferta']);
	$ubicazione = trim($_POST['ubicazione']);

	// verifico se devo eliminare gli slash inseriti automaticamente da PHP
	if(get_magic_quotes_gpc())
	{
		$nome      = stripslashes($nome);
		$costo_trasferta    = stripslashes($costo_trasferta);
                $ubicazione = stripslashes($ubicazione);;
                
	}

                $nome      = mysql_real_escape_string($nome);
                $costo_trasferta    = mysql_real_escape_string($costo_trasferta);
                $ubicazione = mysql_real_escape_string($ubicazione);

	// recupero gli altri campi del form
$giorno = $_POST['datagara'];
$ora=$_POST['oragara'];
$disciplina=$_POST['discipline'];
    // preparo la query
	$query = "INSERT INTO Palestra.gare (NomeGara,costo_trasferta,giorno, ubicazione, disciplina)
			  VALUES ('$nome', '$costo_trasferta','$giorno.$ora','$ubicazione' ,'$disciplina' )";

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