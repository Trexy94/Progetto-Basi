<?php
session_start();
if ($_SESSION['autorizzato']!="allievo")
{
  echo "<h1>Area riservata agli allievi registrati, accesso negato.</h1>";
  echo "Per effettuare il login o la registrazione clicca <a href='progetto.html'>qui</a>";
  die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tutte le gare - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
                <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
    <body></br></br>
	
	<div class="menu">
            <ul class="lista-menu">
            <li><a href="Home.php">Home</a></li> 
			<li><a href="iscriviti_corso.php">iscrizione corsi</a></li> 
                        <li>tutte le gare</li>
            <li><a href="i_maestri.php">Maestri</a></li>
           
            </ul>
        </div>

        <?php
require "tabelle.php";
require 'connect.php';
connect();
echo '<h1>TUTTE LE PROSSIME GARE</h1>';
?>
		
		<?php
echo '<h2></br>Gare di BJJ</h2>';
        // preparo la query
	$query = "select Giorno,Disciplina,NomeGara,Ubicazione,Costo_trasferta from palestra.gare where Disciplina='BJJ' AND Giorno>=curdate() order by Giorno,Disciplina,Ubicazione asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Data","Disciplina","Nome","Ubicazione","Costo preventivo trasferta"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();


echo '<h2>Gare di Judo</h2>';
        // preparo la query
		$query = "select Giorno,Disciplina,NomeGara,Ubicazione,Costo_trasferta from palestra.gare where Disciplina='Judo' AND Giorno>=curdate() order by Giorno,Disciplina,Ubicazione asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Data","Disciplina","Nome","Ubicazione","Costo preventivo trasferta"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();

echo '<h2>Gare di Karate</h2>';
        // preparo la query
		$query = "select Giorno,Disciplina,NomeGara,Ubicazione,Costo_trasferta from palestra.gare where Disciplina='Karate' AND Giorno>=curdate() order by Giorno,Disciplina,Ubicazione asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Data","Disciplina","Nome","Ubicazione","Costo preventivo trasferta"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();


?>
    </body>
</html>