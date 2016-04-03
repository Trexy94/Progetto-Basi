<?php
session_start();
require 'connect.php';
connect();


	// recupero i campi di tipo "stringa"
	$prezzo      = trim($_POST['prezzo']);

	// verifico se devo eliminare gli slash inseriti automaticamente da PHP
	if(get_magic_quotes_gpc())
	{
		$prezzo      = stripslashes($prezzo);
                
	}

                $prezzo      = mysql_real_escape_string($prezzo);

	// recupero gli altri campi del form
$disciplina=$_POST['discipline'];
$fascia_eta=$_POST['fascia_eta'];
$codice_fiscale =$_SESSION['codice_fiscale'];

if(isset($_POST['agonistico'])){
    // is checked and value = 1
    $agonistico = true;
}
else{
    //is nog checked and value=0
    $agonistico=0;
}
//controllo se è di una materia che può insegnare
$sql="select * from palestra.insegnamento where disciplina='$disciplina' and insegnante='$codice_fiscale'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if($count!='1')
{
echo "<h4>ERRORE!<br\> non insegni $disciplina!</h4>";
header('Refresh: 3; URL=aggiungi_corso.php');
die;
}
    // preparo la query
	$query = "INSERT INTO Palestra.corsi (Insegnante,prezzo,fascia_eta, agonistico, disciplina)
			  VALUES ('$codice_fiscale', '$prezzo','$fascia_eta','$agonistico' ,'$disciplina' )";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
		
                echo"registrazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=aggiungi_corso.php');
                die("Errore nella query $query: " . mysql_error());
	}
    
	echo("Inserimento effettuato con successo");
	header('Refresh: 3; URL=Homemaestro.php');
?>