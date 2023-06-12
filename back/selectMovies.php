<?php 

require("configdb.php");

if (isset($_GET['selectFor'])) {

    $filter = $_GET['selectFor'];
    // echo $_GET['selectFor'];

    $sql = "SELECT * FROM movies WHERE id LIKE '%$filter%' OR name LIKE '%$filter%' OR author LIKE '%$filter%';";

    $cons = $mysqli->query($sql);

    if ($cons) {
        $array = [];

        while ($data = $cons->fetch_assoc()) {
            $array[] = $data;
        }

        echo (json_encode($array));
    } else {
        echo "Nada" . $mysqli->error;
    }
} else {
    echo "Nenhum dado encontrado :(";
}

?>