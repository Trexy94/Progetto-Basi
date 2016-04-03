<?php
session_start();
require 'connect.php';
connect();
$myusername=mysql_real_escape_string($_POST['username']);
$mypassword=mysql_real_escape_string($_POST['password']);
$sql="SELECT * FROM palestra.utenti WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
$_SESSION['username'] = $myusername;
if($count==1){
echo"Benvenuto $myusername, hai effettuato il login con successo";

$sql="SELECT codicefiscale FROM palestra.utenti WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);  
$codice_fiscale=$row[0];
$_SESSION['codice_fiscale']= $codice_fiscale;
$sql="SELECT * FROM palestra.maestri WHERE codfiscale='$codice_fiscale'";//vedo se è maestro
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if ($count==1)
{
	$_SESSION['autorizzato']="ok";
	header('Refresh: 3; URL=Homemaestro.php');
	die;
}
$sql="SELECT * FROM palestra.allievo WHERE codicefiscale='$codice_fiscale'"; //controprova se è allievo
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if ($count==1)
{		
	$_SESSION['autorizzato']="allievo";
	header('Refresh: 3; URL=Home.php');
	die;
}
}
else{
echo"login non riuscito su $myusername , sarai reindirizzato al login tra 3 secondi";
header('Refresh: 3; URL=Progetto.html');
}
?>
