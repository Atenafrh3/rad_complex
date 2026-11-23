<?php
require_once "../../../functions/helpers.php";
require_once "../../../functions/pdo.php";
require_once "../layouts/header.php";
require_once "../layouts/sidebar.php";


$search = $_GET['search'] ?? '';

if ($search == '') {
    $admins = $conn->query("SELECT * FROM `admins`")->fetchAll();
} else {

    $stmt = $conn->prepare("SELECT * FROM admins WHERE firstname LIKE ?");
    $stmt->execute(["%$search%"]);
    $admins = $stmt->fetchAll();
    if (count($admins) == 0) { ?>

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
        <h1 class="h4 mb-3">ادمین‌ها</h1>
        <form method="get" class="pb-3">
            <input type="text" name="search" class="p-1 px-3 rounded border-2 border-success" >
            <button type="submit" class="btn btn-success">
                جستجو
            </button>
            <?php if ($search) { ?>
                <a href="<?= url("view/admin/auth/index.php")  ?>" class="btn btn-danger">
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
                            <th>نام کاربری</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        

                        foreach ($admins as $admin) {
                        ?>
                            <tr>
                                <td><?= $admin['username'] ?></td>
                                <td><?= $admin['status'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#showmodal<?= $admin['id'] ?>">
                                        نمایش
                                    </button>
                                    <a class="btn btn-info text-white" href="<?= Url("view/admin/auth/update.php?id=") . $admin['id'] ?>">ویرایش</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?= $admin['id'] ?>">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="exampleModal<?= $admin['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            <?= $admin['firstname'] . " " . $admin['lastname'] ?>
                                            مطمئن هستید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                            <a href="<?= Url("controllers/auth/deletecontroller.php?id=") . $admin['id'] ?>" type="button"
                                                class="btn btn-danger">حذف</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- view Modal -->
                            <div class="modal fade" id="showmodal<?= $admin['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <li class="d-flex ">
                                                    <p class="ms-2">name: </p>
                                                    <?= $admin['firstname'] ?>
                                                </li>
                                                <li class="d-flex ">
                                                    <p class="ms-2">lastname: </p>
                                                    <?= $admin['lastname'] ?>
                                                </li>
                                                <li class="d-flex ">
                                                    <p class="ms-2">status: </p>
                                                    <?= $admin['status'] ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <tr>
                            <td class="text-success fw-bold">add</td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-success px-3" data-bs-dismiss="modal"><a href="./register.php"><i class="bi bi-plus text-white"></i></a></button>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
require_once "../layouts/footer.php";
?>


<!-- 
<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/theme/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="dashboard.html">ادمین</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav"
                aria-controls="topnav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-5" id="topnav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
                    <li class="nav-item"><a class="nav-link text-white" href="dashboard.html"><i
                                class="bi bi-speedometer2 mx-2"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="books.html"><i class="bi bi-book mx-2"></i>Books</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="users.html"><i
                                class="bi bi-people mx-2"></i>Users</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="reservations.html"><i
                                class="bi bi-journal-check mx-2"></i>Reservations</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="admins.html"><i
                                class="bi bi-shield-lock mx-2"></i>Admins</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="login.html"><i
                                class="bi bi-box-arrow-right mx-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 p-0 border-end bg-light min-vh-100" id="sidebar">
                <div class="p-3">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-diagram-3 fs-4 me-2 text-success"></i>
                        <span class="fw-semibold me-2 text-success">منو</span>
                    </div>
                    <ul class="nav nav-pills pe-0 flex-column gap-1">
                        <li class="nav-item"><a class="nav-link text-black" href="../dashboard/index.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="../view/admin/students/index.php">دانش آموزان</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="../view/admin/students/create.php">افزودن دانش‌آموز</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="../view/admin/teachers/index.php">اساتید</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="../view/admin/teachers/create.php">افزودن اساتید</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="./register.php">ثبت ادمین</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="./index.php"> ادمین</a></li>
                    </ul>
                </div>
            </div> -->