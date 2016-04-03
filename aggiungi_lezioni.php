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
        <title>Aggiungi Lezioni - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
                <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
<body></br></br>

<div class="menu">
            <ul class="lista-menu">
            <li><a href="Homemaestro.php">Home</a></li>
           <li><a href="inserisci_maestro.php">inserisci maestri</a></li>
            <li><a href="preiscrizione_gara.php">preiscrizione gara</a></li>
             <li><a href="aggiungi_gara.php">aggiungi gara</a></li>
             <li><a href="corsi.php">tutti i corsi</a></li>
            <li><a href="aggiungi_corso.php">aggiungi corso</a></li>
            <li>aggiungi lezioni</li>
            <li><a href="agonista.php">amatore agonista</a></li> 
		    <li><a href="allievi_palestra.php">allievi palestra</a></li>
            </ul>
        </div>
        <h2>Lezioni in programma</h2>
    <?php
require "tabelle.php";
require 'connect.php';
connect();
        // preparo la query
	$query = "select Disciplina,fascia_eta,id_corso,inizio,palestra,Prezzo,agonistico from palestra.corsi left join palestra.lezione on id_corso=corso where inizio>=curdate() order by inizio,Disciplina,fascia_eta,id_corso asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Disciplina","Fascia Et&agrave","ID Corso","Data Lezione","Palestra","Prezzo","Agonistico"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
?>
    <h2>Aggiungi Lezioni</h2>
<div id="new_lezione" >  
   <form method="post"  action="insert_lezioni.php" id="f2">
                <table id="tabella" >          
                     <tr>
                        <td>
                            <input type="text" id="id_corso" name="id_corso" placeholder=" id corso" required />
                        </td>
                    </tr>
                   <tr><td><br>Palestra:<br>
                          <select name="Palestra" >
   <option value="Via Boito, Castelfranco Veneto" selected="selected">Via Boito, Castelfranco Veneto  </option>
   <option value="Via Puccini, Castelfranco Veneto">Via Puccini, Castelfranco Veneto </option>
   <option value="Via Verdi, Bella Venezia">Via Verdi, Bella Venezia</option>
                          </select></td></tr> 
					<tr><td><br>Giorno lezione:</td></tr>
                        <tr>
                        <td><input type="date" id="datalezione" name="datalezione" required />
                        </td>
                    </tr>
                    <tr><td>Ora inizio:</td></tr>
                        <tr>
                        <td><input type="time" id="datalezione" name="ora_inizio_lezione" required />
                        </td>
                    </tr>
					<tr><td>Ora fine:</td></tr>
                        <tr>
                        <td><input type="time" id="datalezione" name="ora_fine_lezione" required />
                        </td>
                    </tr>
					 <tr>
                        <td><br>
                        <input type="submit"  name="conferma" value="Conferma" style="font-size:18px; " /> 
                        <input type="button"  name="annulla" value="Annulla" style="font-size:18px;" onclick="location.href='Homemaestro.php'" />
                        </td>
                    </tr>
	
                        
                </table>
            </form> 
</div>
</body>
</html>

