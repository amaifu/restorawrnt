<?php
require_once "../auth/conn.php";
session_start();
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $telp = $_POST["telp"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $people = $_POST["people"];
        $message = $_POST["message"];

        $result = mysqli_query($conn, "UPDATE booking SET client_name = '$name', client_email = '$email', client_telp = '$telp', booking_date = '$date', booking_time = '$time', booking_people = '$people', booking_message = '$message' WHERE id_booking = '$id'");

        if(mysqli_affected_rows($conn) > 0) {
            $_SESSION["message"] = "Data booking berhasil diupdate";
            $json = json_encode("Data berhasil diupdate");
            echo $json;
            header("location: ../../admin");
            exit();
        };
        $_SESSION["message"] = "Data gagal diupdate";
        $json = json_encode("Data gagal diupdate");
        echo $json;
        exit();
    };
    exit();
}
$json = json_encode("Method not allowed!");
echo $json;
