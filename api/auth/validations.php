<?php
session_start();
header("Content-Type: application/json");
require_once "conn.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["submit"])) {
        if($_POST["username"] == "" || $_POST["password"] == "") {
            die;
        } else {
            $_SESSION["formSubmitted"] = true;
        }

            $username = $_POST["username"];
            $password = $_POST["password"];

            if(isset($_SESSION["formSubmitted"]) && $_SESSION["formSubmitted"] == true) {

                $res = mysqli_query($conn, "SELECT username, password, privilege FROM user WHERE username = '$username'");

                if(mysqli_num_rows($res) == 1) {
                    $users = mysqli_fetch_assoc($res);
                    if(password_verify("$password", $users["password"])) {
                        if(isset($_POST["rememberme"])) {
                            $_SESSION["login"] = true;
                            $_SESSION["username"] = $users["username"];
                            setcookie("login", password_hash($users["username"], PASSWORD_DEFAULT));
                            echo json_encode(["message"=>'Login Success!']);
                            unset($_SESSION["formSubmitted"]);
                            header("location: ../../admin");
                            exit();
                        }
                        $_SESSION["login"] = true;
                        $_SESSION["username"] = $users["username"];
                        echo json_encode(["message"=>'Login Success!']);
                        unset($_SESSION["formSubmitted"]);
                        header("location: ../../admin");
                        exit();             
                    }
                    echo json_encode(["message"=>"Password Salah!"]);
                    $_SESSION["auth"] = "Password Salah!";
                    header("location: ../../login");
                    unset($_SESSION["formSubmitted"]);
                    exit();
                }
                echo json_encode(["message"=>"User tidak ditemukan!"]);
                $_SESSION["auth"] = "User tidak ditemukan!";
                header("location: ../../login");

                unset($_SESSION["formSubmitted"]);
            }
    }
    exit();
};

echo json_encode(["message"=>"method not allowed!"]);

