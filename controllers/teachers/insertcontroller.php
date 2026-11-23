<?php
require_once "../../functions/pdo.php";
require_once "../../functions/helpers.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $ncode = $_POST["ncode"];
    $phone = $_POST["phone"];
    $address = $_POST['address'] ?? 'ندارد';
    $profile = $_FILES["profile"]["name"];
    // $img_size = $_FILES["profile"]["size"];  

    $message = "";

    if ($_FILES["profile"]["size"] > 2 * 1024 * 1024) {
        $message = "فایل باید کمتر از ۲ مگابایت باشد";
        $_SESSION['message'] = $message;
        header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
        exit;
    }

    if (
        isset($firstname) && $firstname != ""
        && isset($lastname) && $lastname != ""
        && isset($ncode) && $ncode != ""
        && isset($profile) && $profile != ""
    ) {
        if (strlen($firstname) > 2 && strlen($lastname) > 2) {
            if (strlen($phone) == 11 && strlen($ncode) == 10) {

                $upload_dir = "../../public/image/";
                $target_file = $upload_dir . $_FILES["profile"]["name"];

                if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
                    $stmt = $conn->prepare("SELECT * FROM `teachers` WHERE ncode=?");
                    $stmt->execute([$ncode]);

                    if ($stmt->fetch()) {
                        $message = "تکراری نباشد";
                        $_SESSION['message'] = $message;
                        header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
                        exit();
                    }
                    $stmt = $conn->prepare("INSERT INTO `teachers`(firstname, lastname ,ncode ,phone ,profile) VALUES (? , ? , ? , ? , ? )");
                    $stmt->execute([$firstname, $lastname, $ncode, $phone, $_FILES["profile"]["name"]]);

                    $message = "با موفقیت ثبت شد";
                    $_SESSION['message'] = $message;
                    header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
                    exit();
                } else {
                    $message = "خطا در آپلود فایل";
                    $_SESSION['message'] = $message;
                    header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
                    exit();
                }
            } else {
                $message = "موبایل باید 11 کاراکتر و کد ملی 10 کاراکتر باشد";
                $_SESSION['message'] = $message;
                header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
                exit();
            }
        } else {
            $message = "نام و نام خانوادگی باید حداقل 3 کاراکتر باشد";
            $_SESSION['message'] = $message;
            header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
            exit();
        }
    } else {
        $message = "همه موارد اجباری میباشد!";
        $_SESSION['message'] = $message;
        header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
        exit();
    }
} else {
    header("Location: http://localhost/radcomplex/view/admin/teachers/create.php");
    exit();
}

var_dump($_SESSION);
?>