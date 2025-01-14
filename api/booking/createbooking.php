<?php
require_once "../auth/conn.php";
session_start();

date_default_timezone_set("Asia/Bangkok");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $people = $_POST["people"];
    $message = $_POST["message"];

    $hour = localtime(time(), true)["tm_hour"];
    $minutes = localtime(time(), true)["tm_min"];
    $seconds = localtime(time(), true)["tm_sec"];

    $result = mysqli_query($conn, "INSERT INTO booking VALUE(null, '$name', '$email', '$phone', '$date', '$time', '$people', '$message')");

    if(mysqli_affected_rows($conn) > 0) {
        $_SESSION["message"] = "Terimakasih telah memesan!";
        header("location:../../index.html#book-a-table");
        exit();
    };
    $_SESSION["message"] = "Pesanan gagal!";
    header("location:../../index.html#book-a-table");
}