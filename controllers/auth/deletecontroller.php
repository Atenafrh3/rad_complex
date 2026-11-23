<?php
session_start();
require_once "../../functions/pdo.php";
require_once "../../functions/helpers.php";


if (isset($_GET['id']) && $_GET["id"] > 0) {
    $id = (int) $_GET["id"];

    $query = "DELETE FROM `admins` WHERE id = ?";

    $stm = $conn->prepare($query);
    $stm->execute([$id]);

    $message = "با موفقیت حذف شد";
    $_SESSION['message'] = $message;
    Redirect("view/admin/auth/index.php");

}
 else{
    $message = "error 403";
    $_SESSION['message']=$message;
    Redirect("view/admin/auth/index.php");
}