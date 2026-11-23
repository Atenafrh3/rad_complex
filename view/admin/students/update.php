<?php
require_once "../../../functions/helpers.php";
require_once "../../../functions/pdo.php";

if (isset($_GET["id"]) && $_GET["id"] > 0){
    $id = (int) $_GET["id"];
    $students = $conn->query("SELECT * FROM `students` WHERE id = '$id'")->fetch();
    if (!$students) {
        page404();
    }
} else {
    echo "error401";
    exit;
}
require_once "../layouts/header.php";
require_once "../layouts/sidebar.php";

?>

<div class="col-12 col-md-9 col-lg-10 p-4" id="content">

    <div class="auth-card card border-0 shadow-lg p-4">
        <div class="text-center mb-3">
            <i class="bi bi-person-plus display-6 text-success"></i>
            <div class="fw-bold fs-5 mt-2">ویرایش دانش آموزان</div>
        </div>
        <form action="<?= Url("controllers/students/updatecontroller.php?id=").$students['id']?>" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">name</label>
                    <input type="text" name="firstname" value="<?=$students['firstname']?>" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">lastname</label>
                    <input type="text" name="lastname" value="<?=$students['lastname']?>" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ncode</label>
                    <input type="text" name="ncode" value="<?=$students['ncode']?>" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">phone</label>
                    <input type="text" name="phone" value="<?=$students['phone']?>" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">profile</label>
                    <input type="file" class="form-control" value="<?=$students['profile']?>" name="profile" required accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 mt-3">submit</button>
        </form>
        <div class="text-center mt-2 small">
            Made by Mohammad Rezaei — <a href="https://MOHAMMAD-REZAEI.IR" target="_blank" rel="noopener" class="text-decoration-none">MOHAMMAD-REZAEI.IR</a>
        </div>
    </div>
</div>


<?php
require_once "../layouts/footer.php";
?>











