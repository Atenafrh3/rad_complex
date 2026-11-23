           <?php
            require_once "../layouts/header.php";
            require_once "../layouts/sidebar.php";
            require_once "../../../functions/pdo.php";
            require_once "../../../functions/helpers.php";


            $stmt = $conn->query("SELECT COUNT(*) FROM teachers");
            $teacherscount = $stmt->fetchColumn();
            
            $stmt = $conn->query("SELECT COUNT(*) FROM students");
            $studentscount = $stmt->fetchColumn();

            $stmt = $conn->query("SELECT COUNT(*) FROM admins");
            $adminscount = $stmt->fetchColumn();

            
            

            ?>

           <div class="col-12 col-md-9 col-lg-10 p-4" id="content">

               <h1 class="h3 mb-4">Overview</h1>
               <div class="row g-3">
                   <div class="col-sm-6 col-lg-3">
                       <div class="card shadow-sm border-2 border-success stat-card">
                           <div class="card-body">
                               <div class="d-flex align-items-center gap-3">
                                   <i class="bi bi-journal-check fs-1 me-3 text-success"></i>
                                   <div>
                                       <div class="h5 mb-0"> <?= $teacherscount ?></div>
                                       <div class="text-muted">اساتید</div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-6 col-lg-3">
                       <div class="card shadow-sm border-2 border-success stat-card">
                           <div class="card-body">
                               <div class="d-flex align-items-center gap-3">
                                   <i class="bi bi-people fs-1 me-3 text-success"></i>
                                   <div>
                                       <div class="h5 mb-0"><?= $studentscount ?></div>
                                       <div class="text-muted">دانش‌آموزان</div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-6 col-lg-3">
                       <div class="card shadow-sm border-2 border-success stat-card">
                           <div class="card-body">
                               <div class="d-flex align-items-center gap-3">
                                   <i class="bi bi-book  fs-1 me-3 text-success"></i>
                                   <div>
                                       <div class="h5 mb-0">4</div>
                                       <div class="text-muted">کلاس‌ها</div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-6 col-lg-3">
                       <div class="card shadow-sm border-2 border-success stat-card">
                           <div class="card-body">
                               <div class="d-flex align-items-center gap-3">
                                   <i class="bi bi-shield-lock fs-1 me-3 text-success"></i>
                                   <div>
                                       <div class="h5 mb-0"><?= $adminscount ?></div>
                                       <div class="text-muted">ادمین‌ها</div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="card border-2 border-success shadow-sm mt-4">
                   <div class="card-header bg-white">
                       فعالیت‌های اخیر
                   </div>
                   <div class="card-body">
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item">اساتید جدید</li>
                           <li class="list-group-item">کلاس جدید</li>
                           <li class="list-group-item">ادمین جدید</li>
                       </ul>
                   </div>
               </div>
           </div>

           <?php
            require_once "../layouts/footer.php";
            ?>