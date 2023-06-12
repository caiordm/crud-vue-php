<?php

require('configdb.php');

$sql = "SELECT * FROM movies;";

$consulta = $mysqli -> query($sql) or die("deu erro:" . $mysqli -> error);

$array = [];

while ($data = $consulta->fetch_assoc()) {
    $array[] = $data; 
}

echo(json_encode($array));

mysqli_close($mysqli);

?>