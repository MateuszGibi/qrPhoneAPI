<?php 
    include_once "config/database.php";

    $database = new Database();
    $db = $database -> GetConection();

    $stmt = $db -> query('SELECT id, producer,model, imei FROM phones;');

    while($row = $stmt -> fetch()){
        echo "id: " . $row['id'] . " producer:" . $row['producer'] . " model:" . $row['model'] . " imei:" .  $row['imei'];
        echo '<br>';
    }
?>