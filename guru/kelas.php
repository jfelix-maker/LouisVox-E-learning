<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>E-Learning|Admin</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../assets/img/sekolah/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
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

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
  </head>
  <body>
    <!-- read config -->
    <?php
    require '../config.php';
    if(!isset($_GET['kl'])){
      header('Location: '.url("/guru"));
    }
    $id = $_GET['kl'];
    $dk = ($conn->query("SELECT * FROM tbkelas WHERE id_kelas = '$id'"))->fetch_assoc();
    ?>
    <div class="wrapper">
      <!-- menu -->
       <?php
        $menu = "kelas";
        require 'menu.php';
       ?>
      <!-- end menu -->

      <div class="main-panel">
        <!-- header -->
         <?php 
          require 'header.php';
         ?>
        <!-- end header -->
        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
            <div class="page-header">
              <h3 class="fw-bold mb-3">Kelas</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="<?= url("/guru/"); ?>">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="<?= url("/guru/kelas.php?kl=".$dk['id_kelas']); ?>"><?= $dk['nm_kelas']; ?></a>
                </li>
              </ul>
            </div>
              <div class="ms-md-auto py-2 py-md-0">
               <!-- align right -->
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-round" href="<?= url("/guru/materi.php?kl=".$id); ?>">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                        <i class="fas fa-book-reader"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Materi</p>
                          <?php
                          $qm = $conn->query("SELECT * FROM tbmateri tm, tbmapeldtl tmd WHERE tm.id_mapel_dtl = tmd.id_mapel_dtl AND tmd.id_guru = '$id_guru'");
                          $dm = $qm->num_rows;
                          ?>
                          <h4 class="card-title"><?= $dm; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-round" href="<?= url("/guru/tugas.php?kl=".$id); ?>">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                        <i class="fas fa-shapes"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Tugas</p>
                          <?php
                          $qt = $conn->query("SELECT * FROM tbtugas tt, tbmapeldtl tmd WHERE tt.id_mapel_dtl = tmd.id_mapel_dtl AND tmd.id_guru = '$id_guru'");
                          $dt = $qt->num_rows;
                          ?>
                          <h4 class="card-title"><?= $dt; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-round" href="<?= url("/guru/quiz.php?kl=".$id); ?>">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                        <i class="fas fa-pencil-ruler"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Quiz</p>
                          <?php
                          $qku = $conn->query("SELECT * FROM tbkuis tk, tbmapeldtl tmd WHERE tk.id_mapel_dtl = tmd.id_mapel_dtl AND tmd.id_guru = '$id_guru'");
                          $dku = $qku->num_rows;
                          ?>
                          <h4 class="card-title"><?= $dku; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Data Siswa Kelas <?= $dk['nm_kelas']; ?></div>
                  </div>
                  <div class="card-body">
                    <div class="col-md-12">
                    </div>
                  <table class="table table-hover">
                    <thead> 
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama Siswa</th>
                        </tr>    
                    </thead>
                    <tbody>
                    <?php
                      $query = $conn->query("SELECT * FROM tbsiswa tbs WHERE tbs.id_kelas =  '$id'");
                      $i = 1;
                      while($data = $query->fetch_assoc()){
                    ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $data['nm_siswa']; ?></td>
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/main.min.js"></script>
  </body>
</html>
