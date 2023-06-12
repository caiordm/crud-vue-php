<?php 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "first-conn";
// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli) {
    echo "Tudo OK!";
} else {
    echo "Algum erro :(" . $mysqli->error;
}
?>