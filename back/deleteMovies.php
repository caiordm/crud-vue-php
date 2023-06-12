<?php

require("configdb.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
        
        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "$sql";
        } else {
            echo "Erro ao deletar o filme: " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Dados não recebidos";
    }
} else {
    echo "Método inválido";
}
