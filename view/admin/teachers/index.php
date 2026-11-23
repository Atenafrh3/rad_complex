<?php
require_once "../layouts/header.php";
require_once "../layouts/sidebar.php";
require_once "../../../functions/helpers.php";
require_once "../../../functions/pdo.php";

$search = $_GET['search'] ?? '';

if ($search == '') {
    $teachers = $conn->query("SELECT * FROM `teachers`")->fetchAll();
} else {

    $stmt = $conn->prepare("SELECT * FROM teachers WHERE firstname LIKE ?");
    $stmt->execute(["%$search%"]);
    $teachers = $stmt->fetchAll();

    if (count($teachers) == 0) { ?>

        <div class="toast-container position-fixed top-50 start-50 translate-middle ">
            <div class="toast show" role="alert">

                <div class="toast-body text-center text-danger">
                    اسمی پیدا نشد!
                </div>
            </div>
        </div>

        <script>
            setTimeout(function() {
                document.querySelector('.toast').remove();
            }, 2000);
        </script>

<?php
    }
}
?>
<div class="col-12 col-md-9 col-lg-10 p-4" id="content">
    <div class="d-flex justify-content-between">
        <h1 class="h4 mb-3">اساتید</h1>
        <form method="get" class="pb-3">
            <input type="text" name="search" class="p-1 px-3 rounded border-2 border-success">
            <button type="submit" class="btn btn-success">
                جستجو
            </button>
            <?php if ($search) { ?>
                <a href="<?= url("view/admin/teachers/index.php")  ?>" class="btn btn-danger">
                    حذف فیلتر
                </a>

            <?php } ?>
        </form>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>کد استاد</th>
                            <th>نام </th>
                            <th>نام خانوادگی</th>
                            <th>کد ملی</th>
                            <th>پروفایل</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($teachers as $teacher) {
                            $profileImage = $teacher['profile'];
                            $imagePath = "../../../public/image/" . $profileImage;
                        ?>
                            <tr>
                                <td><?= $teacher['id'] ?></td>
                                <td><?= $teacher['firstname'] ?></td>
                                <td><?= $teacher['lastname'] ?></td>
                                <td><?= $teacher['ncode'] ?></td>

                                <td>
                                    <img width="50px" height="50px" style="object-fit:cover; border-radius:50%;" src="<?= $imagePath ?>">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#showmodal<?= $teacher['id'] ?>">
                                        نمایش
                                    </button>
                                    <a class="btn btn-info text-white" href="<?= Url("view/admin/teachers/update.php?id=") . $teacher['id'] ?>">ویرایش</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?= $teacher['id'] ?>">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="exampleModal<?= $teacher['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">حذف کردن</h1>
                                            <button style="margin: 0 auto 0 0;" type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            آیا از حذف
                                            <?= $teacher['firstname'] . " " . $teacher['lastname'] ?>
                                            مطمئن هستید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                            <a href="<?= Url("controllers/teachers/deletecontroller.php?id=") . $teacher['id'] ?>" type="button"
                                                class="btn btn-danger">حذف</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- view Modal -->
                            <div class="modal fade" id="showmodal<?= $teacher['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-between">
                                            <div>
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">مشخصات</h1>
                                            </div>
                                            <div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <h4><?= $teacher['id'] ?></h4>
                                                </li>
                                                <li class="d-flex ">
                                                    <p class="ms-2">name : </p>
                                                    <?= $teacher['firstname'] ?>
                                                </li>
                                                <li class="d-flex ">
                                                    <p class="ms-2">lastname: </p>
                                                    <?= $teacher['lastname'] ?>
                                                </li>
                                                <li class="d-flex ">
                                                    <p class="ms-2">ncode: </p>
                                                    <?= $teacher['ncode'] ?>
                                                </li>
                                                <li class="d-flex ">
                                                    <p class="ms-2">phone: </p>
                                                    <?= $teacher['phone'] ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <tr>
                            <td class="text-success fw-bold">افزودن</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-success px-3" data-bs-dismiss="modal"><a href="./create.php"><i class="bi bi-plus text-white"></i></a></button>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php
require_once "../layouts/footer.php";
?>