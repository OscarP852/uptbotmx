<?php

$server = "localhost";
$user = "root";
$pass = "";

mysql_connect($server,$user,$pass) or die('No se pudo conectar: ' . mysql_error());
echo 'Connected successfully';
mysql_select_db('bd_chatbot')or die('No se pudo seleccionar la base de datos');

?>