<?php

require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
session_start();



if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $id = (int) $_GET["id"];
    $students = $conn->query("SELECT * FROM `students` WHERE id='$id'")->fetch();
    if (!$students) {
        page404();
    }
} else {
    echo "error 401!";
    exit;
}
if (checkMethod("POST")) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $ncode = $_POST["ncode"];
    $phone = $_POST["phone"];
    $profile = $_FILES["profile"];
    $filesize = $_FILES["profile"]["size"] ?? 0;
    $filename = time() . $_FILES["profile"]["name"];
    $img = $_FILES["profile"]["name"];

    $message = "";
    if ($firstname && $lastname && $ncode && $phone && $profile) {
        if (strlen($firstname) > 2 && strlen($lastname) > 2) {
            if ($filesize < (2 * 1024 * 1024)) {
                if ($img) {
                    $queryimg = ", profile = ?";
                    move_uploaded_file($_FILES["profile"]["tmp_name"], "../../public/image/" . $filename);
                    $exedata = [$firstname, $lastname, $ncode, $phone, $filename];
                } else {
                    $queryimg = " ";
                    $exedata = [$firstname, $lastname, $ncode, $phone];
                }
                $query = "UPDATE `students` SET `firstname`= ?, `lastname`= ?, `ncode`= ?, `phone`= ?, `updated_at`=now() " . $queryimg . "WHERE id='$id'";
                $stm = $conn->prepare($query);
                $stm->execute($exedata);

                $message = "با موفقیت ثبت شد";
                $_SESSION['message'] = $message;
                header("Location: http://localhost/radcomplex/view/admin/students/index.php");
                exit();

            } else {
                $message = "فایل باید کمتر از ۲ مگابایت باشد";
                $_SESSION['message'] = $message;
                header("Location: http://localhost/radcomplex/view/admin/students/create.php");
                exit;
            }
        } else {
            $message = "نام و نام خانوادگی باید حداقل 3 کاراکتر باشد";
            $_SESSION['message'] = $message;
            header("Location: http://localhost/radcomplex/view/admin/students/create.php");
            exit();
        }
    } else {
        echo "error4";
    }
} else {
   echo "error5";
}
