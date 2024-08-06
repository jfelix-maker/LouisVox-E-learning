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
                  <a href="<?= url("/admin"); ?>">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="<?= url("/admin/kelas.php"); ?>">Kelas</a>
                </li>
              </ul>
            </div>
              <div class="ms-md-auto py-2 py-md-0">
               <!-- align right -->
              </div>
            </div>
            <div class="row">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Data Kelas</div>
                  </div>
                  <div class="card-body">
                            <button
                              type="button"
                              class="btn btn-primary"
                              id="form-kelas"
                            >
                              Tambah Kelas
                            </button>
                            <table class="table table-hover">
                      <thead>
                      
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama Kelas</th>
                          <th scope="col">Jumlah Siswa</th>
                          <th scope="col" colspan="3">Aksi</th>
                        </tr>
                      
                      </thead>
                      <tbody>
                      <?php
                        $query = $conn->query("select * from kelas");
                        $i = 1;
                        while($data = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td><?= $data['nm_kelas']; ?></td>
                          <td>0</td>
                          <td>read</td>
                          <td> <button
                              type="button"
                              class="btn btn-warning"
                              id="edit-kelas"
                              data-id="<?= $data['id_kelas']; ?>"
                              data-kelas="<?= $data['nm_kelas']; ?>"
                            >
                              Edit Kelas
                            </button>
                          </td>
                          <td>delete</td>
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

    <!-- Kaiadmin JS -->
    <script src="../assets/js/main.min.js"></script>

    <script>
    var SweetAlert2Demo = (function () {
        var initDemos = function () {
          // add kelas
            $("#form-kelas").click(function (e) {
              swal.fire({
                  title: "Tambah Kelas",
                  html: '<br><input class="form-control" placeholder="Nama Kelas" id="nm_kelas">',
                  showCancelButton: true,
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: true,
              }).then((result) => {
                  if (result.isConfirmed) {
                      var nm_kelas = $("#nm_kelas").val();
                      
                      // Sending data to the API
                      $.ajax({
                          url: '<?= url("/admin/do-kelas.php")?>',
                          type: 'POST',
                          data: { namaKelas: nm_kelas },
                          success: function(response) {
                            swal.fire({
                                title: "",
                                text: "Success",
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
                  } else {
                      swal.fire("", "Cancelled", "error");
                  }
              });
            });

            // edit kelas
            $(document).on('click', '#edit-kelas',function (e) {
              var id = $(this).data('id');
              var kelas = $(this).data('kelas');
              swal.fire({
                  title: "Edit",
                  html: '<br><input class="form-control" placeholder="input2" value="'+kelas+'" id="nama_kelas">',
                  showCancelButton: true,
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: true,
              }).then((result) => {
                  if (result.isConfirmed) {
                      var nama_kelas = $("#nama_kelas").val();
                      
                      // Sending data to the API
                      $.ajax({
                          url: '<?= url("/admin/do-kelas.php")?>',
                          type: 'PUT',
                          data: { idKelas: id, namaKelas: nama_kelas},
                          success: function(response) {
                              swal.fire("", "Success", "success");
                          },
                          error: function(xhr, status, error) {
                              swal.fire("", "Error: " + xhr.responseText, "error");
                          }
                      });
                  } else {
                      swal.fire("", "Cancelled", "error");
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

    //== Class Initialization
    jQuery(document).ready(function () {
        SweetAlert2Demo.init();
    });
</script>
  </body>
</html>
