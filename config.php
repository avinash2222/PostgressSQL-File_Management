<?php
    $dbuser = 'postgres';
    $dbpass = 'Avinash1!';
    $host = 'localhost';
    $dbname = 'DronaMaps';
    $dbh = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, array(
    PDO::ATTR_PERSISTENT => true));
    $db = pg_connect("host=localhost port=5432 dbname=DronaMaps user=postgres password=Avinash1!");
?>