<?php
require_once "../auth/conn.php";
header("content-type: application/json");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $id = $_GET["id"];

        $results = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking = $id");
            $bookings = [];
            if(mysqli_fetch_assoc($results)) {
                foreach ($results as $result) {
                    array_push($bookings, $result);
                }

                $json = json_encode(["bookings"=>$bookings]);
                echo $json;

                exit();
            }

        $json = json_encode(["status"=>404 ,"message"=>"not found"]);
        echo $json;
        exit();
    };

    $results = mysqli_query($conn, "SELECT * FROM booking");

    $bookings = [];
    if(mysqli_fetch_assoc($results)) {
        foreach ($results as $result) {
            array_push($bookings, $result);
        }

        $json = json_encode(["bookings"=>$bookings]);
        echo $json;
    }
    

    
    
} 