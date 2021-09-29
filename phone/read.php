<?php 

    //JSON headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/phone.php';

    //Connect to database
    $database = new Database();
    $db = $database -> getConnection();

    $phone = new Phone($db);

    //Read phones info
    $stm = $phone -> read();
    $num = $stm -> rowCount();
    
    //If there is any data
    if($num > 0){
        
        //Array of phone items
        $phone_arr = array();

        //While there is data to read
        while($row = $stm -> fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            //Create phone item with data
            $phone_item = array(
                "id" => $id,
                "producer" => $producer,
                "model" => $model,
                "imei" => $imei
            );

            //Add phone item to the array
            array_push($phone_arr, $phone_item);

        }

        //Set code status to ok
        http_response_code(200);

        //Convert data to json format
        echo json_encode($phone_arr);

    }
    //If there is no data
    else{

        //Set the code status to not found
        http_response_code(404);

        //Show error in json format
        echo json_encode(
            array("message" => "No phones found")
        );

    }

?>