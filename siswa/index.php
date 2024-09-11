<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>E-Learning</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../assets/img/sekolah/favicon.ico"
      type="image/x-icon"
    />
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <link rel="stylesheet" href="../assets/css/demo.css" />
  </head>
  <body>
    <?php
    require '../config.php';
    ?>
    <div class="wrapper">
       <?php
        $menu = "index";
        require 'menu.php';
       ?>

      <div class="main-panel">
         <?php 
          require 'header.php';
         ?>
        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
            <div class="page-header">
              <h3 class="fw-bold mb-3">dashboard</h3>

            </div>
              <div class="ms-md-auto py-2 py-md-0">
              </div>
            </div>
            <?php
                  $current_time = new DateTime();
                  $current_time = $current_time->format("Y-m-d H:i");
                  $ttugas = ($conn->query("SELECT * FROM `tbtugasdtl` ttd WHERE STR_TO_DATE(ttd.mulai, '%Y-%m-%d %H:%i') < STR_TO_DATE('$current_time', '%Y-%m-%d %H:%i') AND STR_TO_DATE(ttd.selesai, '%Y-%m-%d %H:%i') > STR_TO_DATE('$current_time', '%Y-%m-%d %H:%i');"))->num_rows;
            ?>
            <div class="row">
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="text-decoration-none">
                  <div class="card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                      <div class="h1 m-0 text-primary">
                        <i class="fas fa-tasks"></i> <?= $ttugas; ?>
                      </div>
                      <div class="text-muted mb-3">
                        <strong>Tugas yang belum kamu kerjakan</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="text-decoration-none">
                  <div class="card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                      <div class="h1 m-0 text-warning">
                        <i class="fas fa-question-circle"></i> <?= $tkuis; ?> 
                      </div>
                      <div class="text-muted mb-3">
                        <strong>Kuis yang belum kamu kerjakan </strong>
                      </div>
                    </div>
                  </div>
    </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/js/main.min.js"></script>
  </body>
</html>
