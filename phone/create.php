<?php 

    //JSON headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once('../config/database.php');
    include_once('../objects/phone.php');

    //Connect to db
    $database = new Database();
    $db = $database -> getConnection();

    $phone = new Phone($db);

    //Save data from json format input
    $data = json_decode(file_get_contents('php://input'));

    //Check if input data is empty
    if(!empty($data -> producer) && !empty($data -> model) &&!empty($data -> imei)){

        //Save input data to phone's variables
        $phone -> producer = $data -> producer;
        $phone -> model = $data -> model;
        $phone -> imei = $data -> imei;

        //If phone has been added succesful
        if($phone -> create()){
            
            http_response_code(201);

            echo json_encode(array('massage' => "Phone was created."));

        }
        else{

            http_response_code(503);

            echo json_encode(array('massage' => "Unable to create product."));

        }

    }
    //If data is incomplete
    else{
        
        http_response_code(400);

        echo json_encode(array('massage' => "Unable to create product. Data is incoplete."));

    }


?>