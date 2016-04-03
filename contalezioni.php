<center>
    <?php
session_start();
require 'connect.php';
connect();
$idcorso=$_POST['idcorso'];
if(isset($idcorso))
{$sql="SELECT contalezioni($idcorso)";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);  
$numero=$row[0];
$sql="SELECT guadagnocorso($idcorso)";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);  
$soldi=$row[0];
echo "<h4> al corso con id $idcorso mancano $numero lezioni, il corso ha fruttato in tutto $soldi &euro;</h4>";
}
?>
<form method=post action="contalezioni.php">
    <input name="idcorso" type="text" placeholder="id del corso" />
<input type=submit value="Invia"/>
</form>
</center>