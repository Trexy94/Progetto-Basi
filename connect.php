<?php

function connect() {
    $nomehost = "localhost";//qui va il nome dell'host
    $nomeuser = "root";//qui va lo username del client mysql del pc in uso
    $password = "admin";//qui va la password di mysql del pc in uso, se presente
    $dbname = 'Palestra';
    $connessione = mysql_connect($nomehost, $nomeuser, $password);
    $database_select = mysql_select_db($dbname, $connessione);
}

?>