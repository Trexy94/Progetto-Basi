
<?php

session_start();
require 'connect.php';
connect();
// recupero i campi di tipo "stringa"
$idcorso = trim($_POST['idcorso']);

// verifico se devo eliminare gli slash inseriti automaticamente da PHP
if (get_magic_quotes_gpc()) {
    $idcorso = stripslashes($idcorso);
}

$idcorso = mysql_real_escape_string($idcorso);
$allievo = $_SESSION['codice_fiscale'];
$sql = "SELECT * FROM palestra.agonisti as ag left join palestra.corsi as c on c.disciplina=ag.disciplina WHERE c.id_corso='$idcorso' and ag.allievo='$allievo' and c.fascia_eta=fasciaanni('$allievo') and c.agonistico='1'"; //vedo se è un corso per agonisti
$result = mysql_query($sql);
$count = mysql_num_rows($result);
$sql2 = "SELECT * FROM palestra.allievo join palestra.corsi  WHERE id_corso='$idcorso' and codicefiscale='$allievo' and agonistico='0' and fascia_eta=fasciaanni('$allievo')"; // vedo se è almeno per non agonisti
$result2 = mysql_query($sql2);
$count2 = mysql_num_rows($result2);
if (!$count and ! $count2) {
    echo"corso non esistente o non disponibile per te";
    header('Refresh: 5; URL=iscriviti_corso.php');
    die;
}
$codfiscale = $_SESSION['codice_fiscale'];
// preparo la query
$query = "INSERT INTO Palestra.iscrizione (allievo,corso)
			  VALUES ('$codfiscale','$idcorso')";

// invio la query
$result = mysql_query($query);

// controllo l'esito
if (!$result) {
    echo"operazione non riuscita, sarai reindirizzato al form da ricompilare tra 3 secondi";
    header('Refresh: 3; URL=iscriviti_corso.php');
    die("Errore nella query $query: " . mysql_error());
}
$sql = "SELECT noag.disciplina FROM palestra.non_agonisti as noag left join palestra.corsi as c on c.disciplina=noag.disciplina WHERE c.id_corso='$idcorso' and noag.allievo='$allievo' and c.agonistico='0'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);
if ($count == 1) {
    $row = mysql_fetch_array($result);
    $disciplina = $row[0];
    $sql = "UPDATE palestra.non_agonisti SET Amatore='1' WHERE non_agonisti.Disciplina='$disciplina' AND non_agonisti.Allievo='$allievo';";
    $result = mysql_query($sql);
    if (!$result) {
        echo"operazione non riuscita, non è stato possibile renderti amatore";
        header('Refresh: 3; URL=iscriviti_corso.php');
        die("Errore nella query $query: " . mysql_error());
    }
}
echo("Inserimento effettuato con successo, sarai reindirizzato a breve");
header('Refresh: 3; URL=Home.php');
?>