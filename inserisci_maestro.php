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
        <title>Inserisci Maestro - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
                <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
<body></br></br>

<div class="menu">
            <ul class="lista-menu">
            <li><a href="Homemaestro.php">Home</a></li>
           <li>inserisci maestri</li>
            <li><a href="preiscrizione_gara.php">preiscrizione gara</a></li>
             <li><a href="aggiungi_gara.php">aggiungi gara</a></li>
             <li><a href="corsi.php">tutti i corsi</a></li>
            <li><a href="aggiungi_corso.php">aggiungi corso</a></li>
            <li><a href="aggiungi_lezioni.php">aggiungi lezioni</a></li>
            <li><a href="agonista.php">amatore agonista</a></li> 
		    <li><a href="allievi_palestra.php">allievi palestra</a></li>
            </ul>
        </div>

    <h1>Inserisci Maestro</h1>
<div id="insert_form" >  
   <form method="post"  action="insert_maestro.php" id="f2" onsubmit="return testpass(this)">
                <table id="tabella" >          
                     <tr>
                        <td>
                            <input type="text" id="nome" name="nome" placeholder="nome" required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" id="cognome" name="cognome" placeholder="cognome" required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" id="mail" name="CodFis" placeholder="codice fiscale" required />
                        </td>
                    </tr><tr>
                        <td><input type="text" id="NumTel" name="NumTel" placeholder="numero di telefono" required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" id="mail" name="mail" placeholder="mail/username" required />
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input type="password" id="password" name="Pass" placeholder="password" required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" id="conferma password" name="ConfPass" placeholder="conferma password" required />
                        </td>
                    </tr>
                    <tr><td id="testo_sx"><br>Data di nascita:</td></tr>
                        <tr>
                        <td><input type="date" id="datanascita" name="data" required />
                        </td>
                    </tr>
                    <tr><td id="testo_sx"><br>Spunta le discipline che<br>deve insegnare:</td></tr>
                        <tr><td id="testo_sx"><input type="checkbox" name="insegna_bjj"  value="BJJ" />BJJ</td></tr>
                        <tr><td id="testo_sx"><input type="checkbox" name="insegna_judo"  value="Judo" />Judo</td></tr>
                        <tr><td id="testo_sx"><input type="checkbox" name="insegna_karate"  value="Karate" />Karate</td></tr> 
                    <tr>
                        <td><br>
                        <input type="submit"  name="registrati" value="Conferma" style="font-size:18px; " /> 
                        <input type="button"  name="register" value="Annulla" style="font-size:18px;" onclick="location.href='Homemaestro.php'" />
                        </td>
                    </tr>
                </table>
       <script language="Javascript" type="text/javascript">
<!-- 
function testpass(f2){
  // Verifico che il campo password sia valorizzato in caso contrario
  // avverto dell'errore tramite un Alert
  if (f2.Pass.value == ""){
    alert("Errore: inserire una password!")
    return false
  }
  // Verifico che le due password siano uguali, in caso contrario avverto
  // dell'errore con un Alert
  if (f2.Pass.value != f2.ConfPass.value) {
    alert("La password inserita non coincide con la prima!")
    return false
  }
  return true
}
-->
</script>
            </form> 
</div>
</body>
</html>

