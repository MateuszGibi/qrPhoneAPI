<?php 

    //JSON headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    require_once('../config/database.php');
    require_once('../objects/phone.php');

    //Database connection
    $database = new Database();
    $db = $database -> getConnection();

    $phone = new Phone($db);

    //Get id by GET method
    $phone -> id = isset($_GET['id']) ? $_GET['id'] : die();

    //Set all feilds from database
    $phone -> read_one();

    //If phone exist in database
    if($phone -> id != null){

        $phone_arr = array(
            "id" => $phone -> id,
            "producer" => $phone -> producer,
            "model" => $phone -> model,
            "imei" => $phone -> imei
        );

        http_response_code(200);

        echo json_encode($phone_arr);

    }
    else{

        http_response_code(404);

        echo json_encode(array('massage' => "Phone does not exist."));

    }

?>