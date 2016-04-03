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
        <title>Corsi - Arti Marziali Castelfranco Veneto</title>
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
             <li>tutti i corsi</li>
            <li><a href="aggiungi_corso.php">aggiungi corso</a></li>
            <li><a href="aggiungi_lezioni.php">aggiungi lezioni</a></li>
            <li><a href="agonista.php">amatore agonista</a></li> 
            <li><a href="allievi_palestra.php">allievi palestra</a></li>
            </ul>
        </div>
<h2>calcolo numero di lezioni rimanenti e guadagno per un corso</h2>
<iframe src="contalezioni.php" width="100%" height="auto">
</iframe>
        <h2>Tutti i corsi</h2>
    <?php
require "tabelle.php";
require 'connect.php';
connect();
        // preparo la query
	$query = "select nome,cognome,disciplina,id_corso,fascia_eta,agonistico from palestra.corsi left join palestra.maestri on insegnante=codfiscale order by id_corso asc";
	// invio la query
	$result = mysql_query($query);
        table_start(array("Nome insegnante","Cognome insegnante","Disciplina","ID del corso","fascia d'et&agrave","Agonistico"));         
while ($row = mysql_fetch_row($result)) 
table_row($row);
table_end();
?>
    <h2>Prenditi la gestione di un corso</h2>
<center>
    <?php
$idcorso=$_POST['idcorso'];
if(isset($idcorso))
{
$maestro=$_SESSION['codice_fiscale'];
$sql="select * from palestra.insegnamento where disciplina=(select disciplina from corsi WHERE id_corso ='$idcorso') and insegnante='$maestro'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if(($count!='1')or !$result)
{
echo "<h4>ERRORE!<br\> il corso numero $idcorso non ti &egrave stato assegnato</h4>";
}
else
{   
$sql="UPDATE `palestra`.`corsi` SET `Insegnante` = '$maestro' WHERE `corsi`.`id_corso` = '$idcorso';";
$result=mysql_query($sql);
echo "<h4> il corso numero $idcorso ti &egrave stato assegnato</h4>";
header('Refresh: 3; URL=corsi.php');
die;
}
}
?>
    <form method=post action="">
    <input name="idcorso" type="text" placeholder="id del corso" />
<input type=submit value="Invia"/>
</form>
</center>
</body>
</html>