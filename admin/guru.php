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
        $menu = "guru";
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
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
              <div class="page-header">
                <h3 class="fw-bold mb-3">Guru</h3>
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
                    <a href="<?= url("/admin/guru.php"); ?>">Guru</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Data Guru</div>
                </div>
                <div class="card-body">
                  <form class="input-group" method="GET" action="<?= url("/admin/siswa.php");?>">
                    <div class="input-group-prepend">
                      <input type="text" name="nama" placeholder="Cari Guru ..." class="form-control">
                    </div>
                    <button type="submit" class="btn btn-search pe-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                  </form>
                <table class="table table-hover">
                  <thead> 
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Tahun Ajaran</th>
                        <th scope="col">Masuk Tahun</th>
                        <th scope="col">Lulus Tahun</th>
                        <th scope="col">Aksi</th>
                      </tr>    
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_GET['nama'])){
                      $nama = $_GET['nama'];
                      $query = $conn->query("SELECT * FROM siswa WHERE nm_siswa LIKE '%$nama%'");
                    }else{
                      $query = $conn->query("select * from siswa;");
                    }
                    $i = 1;
                    while($data = $query->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $data['nm_siswa']; ?></td>
                      <td><?= $data['tahun_ajaran']; ?></td>
                      <td> <?= $data['masuk_tahun']; ?></td>
                      <td> <?= $data['lulus_tahun']; ?></td>
                      <td> 
                        <button
                        type="button"
                        class="btn btn-danger"
                        id="reset-guru"
                        data-id="<?= $data['id_user']; ?>">
                          Reset Password
                        </button>
                      </td>
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
            $(document).on('click', '#reset-guru',function (e) {
              var id = $(this).data('id');
              swal.fire({
                  title: "Reset Password",
                  html: '<br><input class="form-control" placeholder="Password Baru" value="'+kelas+'" id="pass_guru">',
                  showCancelButton: true,
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: true,
              }).then((result) => {
                  if (result.isConfirmed) {
                      var nama_kelas = $("#nama_kelas").val();
                      $.ajax({
                          url: '<?= url("/admin/do-kelas.php")?>',
                          type: 'PUT',
                          data: JSON.stringify({ idKelas: id, namaKelas: nama_kelas }),
                          success: function(data, textStatus, xhr) {
                            console.log(data);
                            swal.fire({
                                title: "",
                                text: "Success",
                                icon: "success"
                            }).then((result) => {
                              console.log(result);
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