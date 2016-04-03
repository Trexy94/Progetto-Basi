<?php
session_start();
if ($_SESSION['autorizzato']!="ok")
{
  echo "<h1>Area riservata, accesso negato.</h1>";
  echo "Per effettuare il login clicca <a href='progetto.html'>qui</a>";
  die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Allievi Palestra - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
                <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
    <body id="listastudenti"></br></br>
	
	<div class="menu">
            <ul class="lista-menu">
			<li><a href="Homemaestro.php">Home</a></li>
           <li><a href="inserisci_maestro.php">inserisci maestri</a></li>
            <li><a href="preiscrizione_gara.php">preiscrizione gara</a></li>
             <li><a href="aggiungi_gara.php">aggiungi gara</a></li>
             <li><a href="corsi.php">tutti i corsi</a></li>
            <li><a href="aggiungi_corso.php">aggiungi corso</a></li>
            <li><a href="aggiungi_lezioni.php">aggiungi lezioni</a></li>
            <li><a href="agonista.php">amatore agonista</a></li> 
		    <li>allievi palestra</li>
            </ul>
        </div>
	
        <?php
require "tabelle.php";
require 'connect.php';
connect();
echo '<h2>lista allievi</h2>';
        // preparo la query
	$query = "select * from palestra.allievo order by cognome,nome asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Codice Fiscale", "Nome", "Cognome", "Data di nascita","pagamenti in regola"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();

echo '<h2>lista agonisti</h2>';
        // preparo la query
	$query = "select disciplina,nome,cognome,codicefiscale from agonisti left join allievo on agonisti.allievo=allievo.codicefiscale order by disciplina,allievo asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Disciplina","Nome","Cognome","Codice fiscale"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
echo '<h2>lista non agonisti</h2>';
        // preparo la query

		$query = "select disciplina,nome,cognome,codicefiscale,amatore from non_agonisti left join allievo on non_agonisti.allievo=allievo.codicefiscale order by disciplina,allievo asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Disciplina","Nome","Cognome","Codice fiscale","Amatore"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
?>
    </body>
</html>