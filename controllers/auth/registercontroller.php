<?php

require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";

session_start();


if (checkMethod("POST")) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confpassword = $_POST["confpassword"];

    $message = "";


    if ($username && $password && $confpassword) {
        if (strlen($username) > 2 && strlen($password) > 4) {
            $result = $conn->query("SELECT `username` FROM admins WHERE username = '$username'")->fetchAll();
            if (!$result) {
                $newpassword = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO `admins`(`firstname` , `lastname` ,`username`, `password`) VALUES (? , ? , ? , ?)";
                $stm = $conn->prepare($query);
                $stm->execute([$firstname , $lastname , $username , $newpassword]);
                $message = "با موفقیت ثبت شد";
                $_SESSION['message'] = $message;
                Redirect ("view/admin/auth/register.php");
               
            } else {
                echo "error2";
            }
        } else {
            echo "error3";
        }
    } else {
        echo "error4";
    }
} else {
    echo "error5";
}
