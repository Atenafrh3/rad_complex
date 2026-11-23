<?php

require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";

if(checkMethod("POST")) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username && $password) {
        if(strlen($username) > 2 && strlen($password) > 4) {
            $result = $conn->query("SELECT * FROM admins WHERE username = '$username'")->fetch();
            
            if($result) {
                if(password_verify($password , $result['password'])) {
                    $_SESSION['admin'] = $result['username'];
                    Redirect("view/admin/dashboard/index.php");
                }
            } else {
                echo "error2";  
            }
        } else {
            echo "error3";
        }
    } else {
        echo "error4";
    }
} else{

}

?>

