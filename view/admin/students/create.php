<?php
session_start();
require_once "../layouts/header.php";
require_once "../layouts/sidebar.php";
require_once "../../../functions/helpers.php";
require_once "../../../functions/pdo.php";
?>
<div class="col-12 col-md-9 col-lg-10 p-4" id="content">

    <div class="auth-card card border-0 shadow-lg p-4">
        <div class="text-center mb-3">
            <i class="bi bi-person-plus display-6 text-success"></i>
            <div class="fw-bold fs-5 mt-2">ایجاد اکانت جدید</div>
        </div>
        <form action="../../../controllers/students/insertController.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">نام</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">نام خانوادگی</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">کد ملی</label>
                    <input type="text" name="ncode" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">شماره تلفن</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">پروفایل</label>
                    <input type="file" class="form-control" name="profile" required accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 mt-3">ثبت</button>
        </form>
        
        <div class="text-center mt-2 small">
            <p>Made by Mohammad Rezaei</p>
        </div>
    </div>
</div>


<?php
require_once "../layouts/footer.php";
?>