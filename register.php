<?php
session_start();
require 'connect.php';
connect();
	// recupero i campi di tipo "stringa"
	$nome      = trim($_POST['nome']);
	$cognome    = trim($_POST['cognome']);
	$CodFis = trim($_POST['CodFis']);
        $mail= trim($_POST['mail']);
        $Pass = trim($_POST['Pass']);
        $ConfPass= trim($_POST['ConfPass']);

	// verifico se devo eliminare gli slash inseriti automaticamente da PHP
	if(get_magic_quotes_gpc())
	{
		$nome      = stripslashes($nome);
		$cognome    = stripslashes($cognome);
                $CodFis = stripslashes($CodFis);
                $mail =stripslashes($mail);
                $Pass = stripslashes($Pass);
                $ConfPass= stripslashes($ConfPass);
                
	}

                $nome      = mysql_real_escape_string($nome);
                $cognome    = mysql_real_escape_string($cognome);
                $CodFis = mysql_real_escape_string($CodFis);
                $mail = mysql_real_escape_string($mail);
                $Pass = mysql_real_escape_string($Pass);
                $ConfPass= mysql_real_escape_string($ConfPass);

	// recupero gli altri campi del form
$data = $_POST['data'];
if(isset($_POST['agonistabjj'])){
    // is checked and value = 1
    $agonistabjj = true;
}
else{
    //is nog checked and value=0
    $agonistabjj=0;
}
if(isset($_POST['agonistajudo'])){
    // is checked and value = 1
    $agonistajudo = true;
}
else{
    //is nog checked and value=0
    $agonistajudo=0;
}
if(isset($_POST['agonistakarate'])){
    // is checked and value = 1
    $agonistakarate = true;
}
else{
    //is nog checked and value=0
    $agonistakarate=0;
}





if(isset($_POST['amatorebjj'])){
    // is checked and value = 1
    $amatorebjj = true;
}
else{
    //is nog checked and value=0
    $amatorebjj=0;
}
if(isset($_POST['amatorejudo'])){
    // is checked and value = 1
    $amatorejudo = true;
}
else{
    //is nog checked and value=0
    $amatorejudo=0;
}
if(isset($_POST['amatorekarate'])){
    // is checked and value = 1
    $amatorekarate = true;
}
else{
    //is nog checked and value=0
    $amatorekarate=0;
}
$query = "INSERT INTO Palestra.utenti (username,password,codicefiscale)
			  VALUES ('$mail','$Pass', '$CodFis')";
	$result = mysql_query($query);
	// controllo l'esito
	if (!$result) {
                echo"registrazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=Form.html');
                die("Errore nella query $query: " . mysql_error());
	}
    // preparo la query
	$query = "INSERT INTO Palestra.Allievo (CodiceFiscale,Nome,Cognome,DataNascita, Pagamenti_in_regola)
			  VALUES ('$CodFis','$nome', '$cognome', '$data', '1' )";

	// invio la query
	$result = mysql_query($query);

	// controllo l'esito
	if (!$result) {
                echo"registrazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
                header('Refresh: 3; URL=Form.html');		
                die("Errore nella query $query: " . mysql_error());

	}
        // preparo la query
	
        if ($agonistabjj==1)
        {
                    // preparo la query
	$query = "INSERT INTO Palestra.agonisti (Disciplina,Allievo)
			  VALUES ('BJJ', '$CodFis' )";

	// invio la query
	$result = mysql_query($query);
        }
        else
        {      // preparo la query
	$query = "INSERT INTO Palestra.Non_Agonisti (Disciplina,Allievo,Amatore)
			  VALUES ('BJJ', '$CodFis','$amatorebjj' )";

	// invio la query
	$result = mysql_query($query);
        
        }
        if ($agonistajudo==1)
        {        // preparo la query
	$query = "INSERT INTO Palestra.agonisti (Disciplina,Allievo)
			  VALUES ('Judo', '$CodFis' )";

	// invio la query
	$result = mysql_query($query);
        }
        else {
            
        // preparo la query
	$query = "INSERT INTO Palestra.Non_Agonisti (Disciplina,Allievo,Amatore)
			  VALUES ('Judo', '$CodFis','$amatorejudo' )";

	// invio la query
	$result = mysql_query($query);}
                    
        if ($agonistakarate==1)
             {        // preparo la query
	$query = "INSERT INTO Palestra.agonisti (Disciplina,Allievo)
			  VALUES ('Karate', '$CodFis' )";

	// invio la query
	$result = mysql_query($query);
        }
        else {
            
        // preparo la query
	$query = "INSERT INTO Palestra.Non_Agonisti (Disciplina,Allievo,Amatore)
			  VALUES ('Karate', '$CodFis','$amatorekarate' )";

	// invio la query
	$result = mysql_query($query);}
	// chiudo la connessione a MySQL
	mysql_close();
        
	echo("Inserimento effettuato con successo");
	header('Refresh: 3; URL=Progetto.html');
?>