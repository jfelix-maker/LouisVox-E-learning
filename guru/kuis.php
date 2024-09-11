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
    <link rel="stylesheet" href="../assets/css/main.min.css" />
  </head>
  <body>
    <!-- read config -->
    <?php
    require '../config.php';
    if(!isset($_GET['kl'])&&!isset($_GET['dtl'])){
      header('Location: '.url("/guru"));
    }
    ?>
    <div class="wrapper">
      <!-- menu -->
       <?php
        $menu = "kelas";
        require 'menu.php';
        $kelas = $_SESSION['kelas'];
        $id = $_GET['kl'];
        $dk = ($conn->query("SELECT * FROM tbkelas WHERE id_kelas = '$kelas'"))->fetch_assoc();
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
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-home">
                  Quiz
                </li>
              </ul>
            </div>
              <div class="ms-md-auto py-2 py-md-0">
               <!-- align right -->
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-round">
                    <div class="card-header">
                      <div class="card-head-row card-tools-still-right">
                      <?php
                        if(!isset($_GET['dtl'])){
                      ?>
                        <h4 class="card-title">Form Quiz</h4>
                      <?php
                        }else{
                      ?>
                        <h4 class="card-tools">Form Edit Quiz</h4>
                      <?php
                        }
                      ?>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                        <?php
                          if(!isset($_GET['dtl'])){
                        ?>
                          <form action="do-kuis.php" method="POST" class="form-group">
                            <input type="hidden" name="id_dtl" value="<?= $id; ?>"/>                          
                            <label>Judul Kuis</label>
                            <input type="text" class="form-control" name="nm_kuis" placeholder="Judul Kuis" required>
                            <label>Mulai</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="mulai_date" placeholder="Mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control" name="mulai_time" placeholder="Mulai" required>
                                </div>
                            </div>
                            <label>Selesai</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="selesai_date" placeholder="Mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control" name="selesai_time" placeholder="Mulai" required>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="form-control btn btn-primary"> Submit</button>
                          </form>
                        <?php
                          }
                        ?>
                        </div>
                        <div class="col-md-6">
                          <?php
                            if(isset($_GET['dtl'])){
                              $dtl = $_GET['dtl'];
                              $raw = ($conn->query("SELECT * FROM tbkuis tk WHERE tk.id_kuis = '$dtl' LIMIT 1;"))->fetch_assoc();
                              $m = explode(' ', $raw['mulai']);
                              $s = explode(' ', $raw['selesai']);
                          ?>
                            <form action="do-kuis.php" method="POST" class="form-group" enctype="multipart/form-data">
                              <input type="hidden" name="PUT" value="<?= $dtl; ?>"/>
                              <input type="hidden" name="id_dtl" value="<?= $id; ?>"/>                             
                              <label>Judul Kuis</label>
                              <input type="text" class="form-control" value="<?= $raw['nm_kuis']; ?>" name="nm_kuis" placeholder="Judul Kuis" required>
                              <label>Mulai</label>
                              <div class="row g-3">
                                  <div class="col-md-6">
                                      <input type="date" class="form-control" value="<?= $m[0]; ?>" name="mulai_date" placeholder="Mulai" required>
                                  </div>
                                  <div class="col-md-6">
                                      <input type="time" class="form-control" value="<?= $m[1]; ?>" name="mulai_time" placeholder="Mulai" required>
                                  </div>
                              </div>
                              <label>Selesai</label>
                              <div class="row g-3">
                                  <div class="col-md-6">
                                      <input type="date" class="form-control" value="<?= $s[0]; ?>" name="selesai_date" placeholder="Mulai" required>
                                  </div>
                                  <div class="col-md-6">
                                      <input type="time" class="form-control" value="<?= $m[1]; ?>" name="selesai_time" placeholder="Mulai" required>
                                  </div>
                              </div>
                              <br>
                              <button type="submit" class="form-control btn btn-primary"> Submit</button>
                            </form>
                          <?php
                            }
                          ?>
                        </div>  
                      </div>            
                    </div>
                  </div>
                </div>

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Data Quiz Kelas <?= $dk['nm_kelas']; ?></div>
                  </div>
                  <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead> 
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama Kuis</th>
                          <th scope="col">Mulai</th>
                          <th scope="col">Selesai</th>
                          <th scope="col" colspan="3">Aksi</th>
                        </tr>    
                    </thead>
                    <tbody>
                    <?php
                      $query = $conn->query("SELECT * FROM tbkuis tk WHERE tk.id_mapel_dtl = '$id' ORDER BY tk.mulai ASC");
                      $i = 1;
                      while($data = $query->fetch_assoc()){
                    ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $data['nm_kuis']; ?></td>
                        <td><?= tanggal($data['mulai']); ?></td>
                        <td><?= tanggal($data['selesai']); ?></td>
                        <td><a href="<?= url("/guru/soal-kuis.php?kl=".$data['id_kuis']); ?>" class="btn btn-info"> Soal</a></td>
                        <td><a href="<?= url("/guru/kuis.php?kl=".$id."&dtl=".$data['id_kuis']); ?>" class="btn btn-warning"> Edit</a></td>
                        <td><button
                        type="button"
                        class="btn btn-danger"
                        id="del-kuis"
                        data-id="<?= $data['id_kuis']; ?>">
                          Delete
                        </button></td>
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
    <script src="../assets/js/plugin/sweetalert/sweetalert2-11.js"></script>
  
    <!-- Custome JS -->
    <script src="../assets/js/main.min.js"></script>

    <script>
    var SweetAlert2Demo = (function () {
        var initDemos = function () {
            $(document).on('click', '#del-kuis',function (e) {   
              var id = $(this).data('id');
              Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data akan di hapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus Sekarang!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: '<?= url("/guru/do-kuis.php")?>',
                    type: 'DELETE',
                    data: JSON.stringify({ idKuis: id}),
                    success: function(data, textStatus, xhr) {
                    console.log(data);
                    swal.fire({
                      title: "",
                      text: "Kuis Terhapus",
                      icon: "success"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                    },
                    error: function(xhr, status, error) {
                      swal.fire("", "Error: " + xhr.responseText, "error");
                    }
                  });
              
                }
              });
            });
        };

        return {
            init: function () {
                initDemos();
            },
        };
    })();

    jQuery(document).ready(function () {
        SweetAlert2Demo.init();
    });
</script>
  </body>
</html>
