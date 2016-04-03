<?php 
/* Inizia una tabella html. In input l'array degli 
 header delle colonne */
function table_start($row) { 
echo "<table class='tabelle'>"; 
echo "<tr>"; 
foreach ($row as $field) 
echo "<th>$field</th>";
echo "</tr>";
};
/* Stampa un array, come riga di tabella html */
function table_row($row) { 
echo "<tr>"; 
foreach ($row as $field) 
if ($field) /* gestione valori nulli! */ 
	echo "<td>$field</td>";
 else
	echo "<td>-</td>"; echo "</tr>";};
/* funzione per terminare una tabella html */
function table_end() { 
echo "</table>";};
?>