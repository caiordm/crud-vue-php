<?php

require("configdb.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['author'])) {
        $name = $_POST['name'];
        $author = $_POST['author'];

        $sql = "INSERT INTO movies (name, author) VALUES ('$name', '$author');";

        // $consulta = $mysqli->query($sql) or die("Erro meu patrão $mysqli->error");
        // mysqli_close($mysqli);

        if ($mysqli->query($sql)) {
            echo "Filme cadastrado corretamente!";
        } else {
            echo "Erro ao cadastrar filme" . $mysqli->error;
        }
        
        mysqli_close($mysqli);
    } else {
        echo "Os dados não chegaram corretamente :(";
    }
} else {
    echo "Método inválido";
}
