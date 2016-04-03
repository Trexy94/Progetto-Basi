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
        <title>Allievo Homepage - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
                <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
<body></br></br>

	<div class="menu">
            <ul class="lista-menu">
            <li>home</li>
			<li><a href="iscriviti_corso.php">iscrizione corsi</a></li> 
                        <li><a href="tutte_le_gare.php">tutte le gare</a></li>
            <li><a href="i_maestri.php">Maestri</a></li>
           
            </ul>
        </div>
		

<?php
echo("<h1>ciao ".$_SESSION['username']."</h1>");
?>
		
		 <h2>Prossime Lezioni</h2>
    <?php
require "tabelle.php";
require 'connect.php';
connect();
$CF=$_SESSION['codice_fiscale'];
        // preparo la query
	$query = "select c.Disciplina,c.fascia_eta,c.id_corso,l.inizio,l.palestra,c.Prezzo,c.agonistico from (((palestra.corsi as c join palestra.lezione as l on c.id_corso=l.corso) join palestra.iscrizione as i on c.id_corso=i.Corso) join palestra.allievo as a on i.Allievo=a.CodiceFiscale)  where l.inizio>=curdate() and i.Allievo='$CF' order by c.Disciplina,c.fascia_eta,c.id_corso asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Disciplina","Fascia Et&agrave","ID","Data Lezione","Palestra","Prezzo","Agonistico"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
?>

 <h2>Gare a cui sei preiscritto</h2>
    <?php
        // preparo la query
	$query = "select b.GiornoGara,b.Disciplina,a.NomeGara,b.UbicazioneGara,a.Costo_trasferta from palestra.gare as a right join palestra.preiscrizioni as b on a.Ubicazione=b.UbicazioneGara where a.Giorno=b.GiornoGara and a.Disciplina=b.Disciplina and a.Giorno>=curdate() and Allievo='$CF' order by a.Giorno,a.Disciplina asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Data","Disciplina","Nome Gara","Ubicazione","Costo preventivo trasferta"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
?>

</body>
</html>