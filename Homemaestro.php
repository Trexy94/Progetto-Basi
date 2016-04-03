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
        <title>Maestro Homepage - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
                <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
<body></br></br>
			<div class="menu">
            <ul class="lista-menu">
            <li>home</li>
           <li><a href="inserisci_maestro.php">inserisci maestri</a></li>
            <li><a href="preiscrizione_gara.php">preiscrizione gara</a></li>
             <li><a href="aggiungi_gara.php">aggiungi gara</a></li>
             <li><a href="corsi.php">tutti i corsi</a></li>
            <li><a href="aggiungi_corso.php">aggiungi corso</a></li>
            <li><a href="aggiungi_lezioni.php">aggiungi lezioni</a></li>
            <li><a href="agonista.php">amatore agonista</a></li> 
		    <li><a href="allievi_palestra.php">allievi palestra</a></li>
            </ul>
        </div>
<?php
echo("<h1>ciao ".$_SESSION['username']."</h1>");
require "tabelle.php";
require 'connect.php';
connect();
echo '<h2>lista delle tue prossime lezioni</h2>';
        // preparo la query
        $maestro=$_SESSION['codice_fiscale'];
	$query = "select disciplina,fascia_eta,agonistico,inizio,fine,palestra from palestra.lezione left join palestra.corsi on corso=id_corso where insegnante='$maestro' and inizio>curdate() order by inizio asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("disciplina", "fascia d'et&agrave", "Agonistico", "inizio","fine","palestra"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();

echo '<h2>lista dei tuoi allievi</h2>';
        // preparo la query
	$query = "select distinct nome,cognome,datanascita,pagamenti_in_regola from palestra.iscrizione left join palestra.corsi on corso=id_corso left join palestra.allievo on codicefiscale=allievo where insegnante='$maestro' order by cognome,nome asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Nome","Cognome","data di nascita","pagamenti in regola"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
?>
</body>
</html>