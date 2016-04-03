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
        <title>Aggiungi Gara - Arti Marziali Castelfranco Veneto</title>
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
             <li>aggiungi gara</li>
             <li><a href="corsi.php">tutti i corsi</a></li>
            <li><a href="aggiungi_corso.php">aggiungi corso</a></li>
            <li><a href="aggiungi_lezioni.php">aggiungi lezioni</a></li>
            <li><a href="agonista.php">amatore agonista</a></li> 
		    <li><a href="allievi_palestra.php">allievi palestra</a></li>
            </ul>
        </div>

    <h1>Aggiungi Gara</h1>
<div id="new_gara" >  
   <form method="post"  action="insert_gara.php" id="f3">
                <table id="tabella" >          
                     <tr>
                        <td>
                            <input type="text" id="nome" name="nome" placeholder="nome" required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" id="costo_trasferta" name="costo_trasferta" placeholder="costo stimato trasferta" required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" id="ubicazione" name="ubicazione" placeholder="ubicazione" required />
                        </td>
                    </tr>
                    <tr><td id="testo_sx">Giorno:</td></tr>
                        <tr>
                        <td><input type="date" id="datagara" name="datagara" required />
                        </td>
                    </tr>
                                        <tr><td id="testo_sx">Ora:</td></tr>
                        <tr>
                        <td><input type="time" id="datagara" name="oragara" required />
                        </td>
                    </tr>
                    <tr><td id="testo_sx"><br>Disciplina:
                          <select name="discipline" >
   <option value="BJJ" selected="selected">BJJ  </option>
   <option value="Judo">Judo </option>
   <option value="Karate">Karate</option>
                          </select></td></tr> 
                    <tr>
                        <td><br>
                        <input type="submit"  name="registrati" value="Conferma" style="font-size:18px; " /> 
                        <input type="button"  name="register" value="Annulla" style="font-size:18px;" onclick="location.href='Homemaestro.php'" />
                        </td>
                    </tr>
                </table>
            </form> 
</div>
</body>
</html>

