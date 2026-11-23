<?php

require_once "../../../functions/helpers.php";
require_once "../../../functions/pdo.php";
require_once "../layouts/header.php";
require_once "../layouts/sidebar.php";


if (isset($_GET["id"]) && $_GET["id"] > 0){
    $id = (int) $_GET["id"];
    $admins = $conn->query("SELECT * FROM `admins` WHERE id = '$id'")->fetch();
    if (!$admins) {
        page404();
    }
} else {
    echo "error401";
    exit;
}

?>
<div class="col-12 col-md-9 col-lg-10 p-4" id="content">
    <div class="auth-card card border-0 shadow-lg p-4">
        <div class="text-center mb-3">
            <i class="bi bi-person-plus display-6 text-success"></i>
            <div class="fw-bold fs-5 mt-2">ویرایش اطلاعات </div>
        </div>
        <form action="../../../controllers/auth/editcontroller.php" method="post">
            <div class="row g-3">
                <input type="hidden" name="id" value="<?= $admins['id'] ?>">
                <div class="col-md-6">
                    <label class="form-label">نام</label>
                    <input type="text" class="form-control" value="<?= $admins['firstname'] ?>" name="firstname" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">نام خانوادگی</label>
                    <input type="text" class="form-control" value="<?= $admins['lastname'] ?>" name="lastname" required>
                </div>
                <div class="col-12">
                    <label class="form-label">نام کاربری</label>
                    <input type="text" class="form-control" value="<?= $admins['username'] ?>" name="username" required>
                </div>
                <div class="col-12">
                    <label class="form-label"> تغییر کلمه عبور</label>
                    <input type="text" class="form-control" name="">
                </div>

            </div>
            <button type="submit" class="btn btn-success w-100 mt-3">ثبت نام</button>


        </form>
        <div class="text-center mt-2 small">
            <p>Made by Mohammad Rezaei</p>
        </div>

    </div>
</div>
<?php

require_once "../layouts/footer.php";

?>