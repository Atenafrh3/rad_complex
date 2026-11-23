<?php

require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
session_start();



if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $id = (int) $_GET["id"];
    $admins = $conn->query("SELECT * FROM `admins` WHERE id='$id'")->fetch();
    if (!$admins) {
        page404();
    }
} else {
    
}


if (checkMethod("POST")) {
    $id = (int) $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];

    $message = "";


    if ($username && $firstname && $lastname) {
        if (strlen($username) > 4) {

            $query = "UPDATE `admins` SET `firstname`= ?, `lastname`= ?, `username` = ?, `updated_at`=now() Where id=? ";
            $stm = $conn->prepare($query);
            $stm->execute([$firstname, $lastname, $username, $id]);
            $message = "با موفقیت ثبت شد";
            $_SESSION['message'] = $message;
            Redirect("view/admin/auth/index.php");
        } else {
            echo "error3";
        }
    } else {
        echo "error4";
    }
} else {
    echo "error5";
}


?>





