<?php
session_start();
if ($_SESSION['autorizzato'] != "allievo") {
    echo "<h1>Area riservata agli allievi registrati, accesso negato.</h1>";
    echo "Per effettuare il login o la registrazione clicca <a href='progetto.html'>qui</a>";
    die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Iscriviti corso - Arti Marziali Castelfranco Veneto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <base href=""/>
        <link href="Main.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'/>

    </head>
    <body></br></br>
        <div class="menu">
            <ul class="lista-menu">
                <li><a href="Home.php">Home</a></li> 
                <li>iscrizione corsi</li> 
                <li><a href="tutte_le_gare.php">tutte le gare</a></li>
                <li><a href="i_maestri.php">Maestri</a></li>
            </ul>
        </div>

        <div id="lista_corsi">
            <?php
            require "tabelle.php";
            require 'connect.php';
            connect();
            $allievo = $_SESSION['codice_fiscale'];
            $sql = "SELECT disciplina FROM palestra.agonisti WHERE Allievo='$allievo'";
            $result = mysql_query($sql);
            $count = mysql_num_rows($result);
            if ($count >= 1) {
                $select = "SELECT nome,cognome,disciplina,prezzo,id_corso,fascia_eta from corsi left join maestri on insegnante=codfiscale where agonistico='1' and fascia_eta=fasciaanni('$allievo') and id_corso not in (select corso from palestra.iscrizione where allievo='$allievo') and (";
                while ($row = mysql_fetch_array($result)) {
                    $select = $select . "disciplina='$row[0]' or ";
                }
                $select = $select . "false)";
                $result = mysql_query($select);
                $count = mysql_num_rows($result);
                if ($count >= 1) {
                    echo '<h2>corsi per agonisti a cui puoi iscriverti</h2>';
                    table_start(array("Nome insegnante", "Cognome insegnante", "disciplina", "prezzo", "id corso", "fascia d'et&agrave"));
                    while ($row = mysql_fetch_row($result))
                        table_row($row);
                    table_end();
                } else {
                    echo '<h3>nessun corso per agonisti a cui puoi iscriverti</h3>';
                }
            }
            $query = "SELECT nome,cognome,disciplina,prezzo,id_corso,fascia_eta from corsi left join maestri on insegnante=codfiscale where agonistico='0' and fascia_eta=fasciaanni('$allievo') and id_corso not in (select corso from palestra.iscrizione where allievo='$allievo')";
            $result = mysql_query($query);
            $count = mysql_num_rows($result);
            if ($count >= 1) {
                echo '<h2>corsi aperti anche agli amatori</h2>';
                table_start(array("Nome insegnante", "Cognome insegnante", "disciplina", "prezzo", "id corso", "fascia d'et&agrave"));
                while ($row = mysql_fetch_row($result))
                    table_row($row);
                table_end();
            } else {
                echo '<h3>nessun corso per amatori a cui puoi iscriverti</h3>';
            }
            ?>
        </div>
        <div id="iscrizione corso" > 
            <h2>Iscriviti ad un corso</h2>
            <form method="post"  action="actioncorso.php" id="fg">
                <input type="text" id="nome" name="idcorso" placeholder="id del corso a cui vuoi iscriverti" required style="width:15em" />
                <input type="submit"  name="conferma" value="Conferma" />
                <input type="button"  name="annulla" value="Annulla" onclick="location.href = 'Home.php'" />
            </form>
        </div>
    </body>
</html>