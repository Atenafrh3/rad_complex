<?php
require_once "../../../functions/helpers.php";
require_once "../../../functions/pdo.php";
require_once "../layouts/header.php";
require_once "../layouts/sidebar.php";
?>


<div class="col-12 col-md-9 col-lg-10 p-4" id="content">
    <div class="auth-card card border-0 shadow-lg p-4 px-5 ">
        <div class="text-center mb-3">
            <i class="bi bi-book-half display-6 text-success"></i>
            <div class="fw-bold fs-5 mt-2">ادمین</div>
        </div>
        <form action="../../../controllers/auth/logincontroller.php" method="post" class="px-5">
            <div class="mb-3 text-center">
                <label class="form-label">نام کاربری</label>
                <input type="text" class="form-control w-100" name="username" required style="width: 300px;">
            </div>
            <div class="mb-3 text-center">
                <label class="form-label">کلمه عبور</label>
                <input type="password" class="form-control w-100" name="password" required style="width: 300px;">
            </div>
            <button type="submit" class="btn btn-success w-100 mt-3">ورود</button>
            <div class="d-flex justify-content-center align-items-center mt-4">

                <a href="./register.php" class="small text-decoration-none ">ایجاد حساب جدید</a>
            </div>
        </form>
        <div class="text-center mt-3 small">
            <p>Made by Mohammad Rezaei</p>
        </div>
    </div>
</div>


<?php

require_once "../layouts/footer.php";

?>