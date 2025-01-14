<?php
require_once "../auth/conn.php";
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $result = mysqli_query($conn, "DELETE FROM booking WHERE id_booking = $id");
        if(mysqli_affected_rows($conn) > 0) {
            header("location: ../../admin");
            exit();
        }
        echo "Error!";
        exit();
    }
    echo "needed id for delete!!!";
    exit();
    
}  