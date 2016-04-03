<?php
session_start();
require 'connect.php';
connect();
	// recupero i campi di tipo "stringa"
	$nome      = trim($_POST['nome']);
	$cognome    = trim($_POST['cognome']);
	$CodFis = trim($_POST['CodFis']);
	$NumTel= trim($_POST['NumTel']);
        $mail= trim($_POST['mail']);
		$Pass = trim($_POST['Pass']);
        $ConfPass= trim($_POST['ConfPass']);

	// verifico se devo eliminare gli slash inseriti automaticamente da PHP
	if(get_magic_quotes_gpc())
	{
		$nome      = stripslashes($nome);
		$cognome    = stripslashes($cognome);
                $CodFis = stripslashes($CodFis);
				$NumTel= stripslashes($NumTel);
                $mail =stripslashes($mail);
                $Pass = stripslashes($Pass);
                $ConfPass= stripslashes($ConfPass);
                
	}

                $nome      = mysql_real_escape_string($nome);
                $cognome    = mysql_real_escape_string($cognome);
                $CodFis = mysql_real_escape_string($CodFis);
				$NumTel= mysql_real_escape_string($NumTel);
                $mail = mysql_real_escape_string($mail);
                $Pass = mysql_real_escape_string($Pass);
                $ConfPass= mysql_real_escape_string($ConfPass);

	// recupero gli altri campi del form
$data = $_POST['data'];
if(isset($_POST['insegna_bjj'])){
    // is checked and value = 1
    $insegna_bjj = true;
}
else{
    //is nog checked and value=0
    $insegna_bjj=0;
}
if(isset($_POST['insegna_judo'])){
    // is checked and value = 1
    $insegna_judo = true;
}
else{
    //is nog checked and value=0
    $insegna_judo=0;
}
if(isset($_POST['insegna_karate'])){
    // is checked and value = 1
    $insegna_karate = true;
}
else{
    //is nog checked and value=0
    $insegna_karate=0;
}    
//controllo se insegna almeno una disciplina

   if (!($insegna_bjj or $insegna_judo or $insegna_karate))
   {
       echo"<h1>il maestro deve insegnare almeno una disciplina!</h1>";
                header('Refresh: 3; URL=inserisci_maestro.php');		
                die;
   }

    // preparo la query
	$query = "INSERT INTO Palestra.utenti (username,password,codicefiscale)
			  VALUES ('$mail','$Pass', '$CodFis')";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
                echo"registrazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=inserisci_maestro.php');		
                die("Errore nella query $query: " . mysql_error());

	}
    // preparo la query
	$query = "INSERT INTO Palestra.Maestri (codfiscale,Nome,Cognome,DataNascita,NumTel)
			  VALUES ('$CodFis','$nome', '$cognome', '$data', '$NumTel')";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
                echo"registrazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=inserisci_maestro.php');		
                die("Errore nella query $query: " . mysql_error());

	}

        if ($insegna_bjj==1)
        {
                    // preparo la query
	$query = "INSERT INTO Palestra.insegnamento (Disciplina,Insegnante)
			  VALUES ('BJJ', '$CodFis' )";

	// invio la query
	$result = mysql_query($query);
        }
        if ($insegna_judo==1)
        {        // preparo la query
	$query = "INSERT INTO Palestra.insegnamento (Disciplina,Insegnante)
			  VALUES ('Judo', '$CodFis' )";

	// invio la query
	$result = mysql_query($query);
        }        
        if ($insegna_karate==1)
             {        // preparo la query
	$query = "INSERT INTO Palestra.insegnamento (Disciplina,Insegnante)
			  VALUES ('Karate', '$CodFis' )";

	// invio la query
	$result = mysql_query($query);
        }
	// chiudo la connessione a MySQL
	mysql_close();
        
	echo("Inserimento effettuato con successo");
	header('Refresh: 3; URL=Homemaestro.php');
?>