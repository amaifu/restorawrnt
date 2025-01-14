<?php
session_start();
require_once "conn.php";
header("content-type: application/json");
if($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = mysqli_query($conn, "SELECT * FROM user");

    $users = mysqli_fetch_assoc($result);
    
    $_SESSION["username"] = $users["username"];

    echo json_encode($users);
}