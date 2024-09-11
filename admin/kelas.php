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
    $id = 0;
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $kelas = $conn->query("SELECT * FROM tbkelas WHERE id_kelas = '$id'");
      $kelas = $kelas->fetch_assoc();
    }
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
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
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
                  <?php 
                  if($id>0){
                  ?>
                  <li class="separator">
                    <i class="icon-arrow-right"></i>
                  </li>
                  <li class="nav-item">
                    <a href="<?= url("/admin/kelas.php?id=".$id); ?>"><?= $kelas['nm_kelas']; ?></a>
                  </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <?php
              if($id > 0){
              ?>
              <div class="card">
                <div class="card-header card-head-row">
                  <div class="card-title">Data <?= $kelas['nm_kelas']; ?></div>
                  <div class="card-tools">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                          <li class="nav-item submenu">
                           <div class="form-group">Tahun Ajar</div> 
                          </li>
                          <li class="nav-item" role="presentation">
                            <?php
                            $qu_th = $conn->query("SELECT tahun_ajaran FROM tbsiswa WHERE id_kelas = '$id' GROUP BY tahun_ajaran;");
                            $d_th = $qu_th->fetch_assoc();
                            ?>
                            <select class="form-select" id="tahun-ajar">
                              <?php
                              if($d_th['tahun_ajaran'] == 0 || $qu_th->num_rows == 0){
                                $d_th['tahun_ajaran'] = 0;
                              ?>
                              <option value="0" selected>Kosong</option>
                              <?php
                              }
                              for($tahun = $env['TAHUN']; $tahun < date("Y")+5; $tahun++){
                              ?>
                              <option <?= ($d_th['tahun_ajaran'] == $tahun.'.1' || false) ? 'selected' : ''; ?> value="<?= $tahun; ?>.1"><?= $tahun; ?> Ganjil</option>
                              <option <?= ($d_th['tahun_ajaran'] == $tahun.'.2' || false) ? 'selected' : ''; ?> value="<?= $tahun; ?>.2"><?= $tahun; ?> Genap</option>
                              <?php
                                }
                              ?>
                            </select>
                          </li>
                        </ul>
                      </div>
                </div>
                <div class="card-body">
                  <button
                  type="button"
                  class="btn btn-primary"
                  id="form-siswa">
                    Tambah Siswa
                </button>
               
                <table class="table table-hover">
                  <thead> 
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Tahun Masuk</th>
                        <th scope="col">Tahun Lulus</th>
                      </tr>    
                  </thead>
                  <tbody>
                  <?php
                    $query = $conn->query("SELECT * FROM tbsiswa s, tbuser u WHERE u.uid = s.id_user AND s.id_kelas = '$id'");
                    $i = 1;
                    while($data = $query->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $data['nm_siswa']; ?></td>
                      <td><?= $data['masuk_tahun']; ?></td>
                      <td><?= $data['lulus_tahun']; ?></td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
                </div>
              </div>
              <?php
              }else{
              ?>
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Data Kelas</div>
                </div>
                <div class="card-body">
                  <button
                  type="button"
                  class="btn btn-primary"
                  id="form-kelas">
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
                    $query = $conn->query("SELECT *, (SELECT COUNT(*)FROM tbsiswa s WHERE s.id_kelas = k.id_kelas) as jml_siswa from tbkelas k;");
                    $i = 1;
                    while($data = $query->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $data['nm_kelas']; ?></td>
                      <td><?= $data['jml_siswa']; ?></td>
                      <td> <a href="<?= url("/admin/kelas.php?id=".$data['id_kelas']); ?>" type="button" class="btn btn-info">read</a></td>
                      <td> 
                        <button
                        type="button"
                        class="btn btn-warning"
                        id="edit-kelas"
                        data-id="<?= $data['id_kelas']; ?>"
                        data-kelas="<?= $data['nm_kelas']; ?>">
                          Edit
                        </button>
                      </td>
                      <td><button
                        type="button"
                        class="btn btn-danger"
                        id="del-kelas"
                        data-id="<?= $data['id_kelas']; ?>"
                        >
                          Delete
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
            <?php
              }
            ?>
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
          var id = <?= $id; ?>;
            $("#form-kelas").click(function (e) {
              swal.fire({
                  title: "Tambah Kelas",
                  html: '<br><input class="form-control" placeholder="Nama Kelas" id="nm_kelas" required>',
                  showCancelButton: true,
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: true,
              }).then((result) => {
                  if (result.isConfirmed) {
                      var nm_kelas = $("#nm_kelas").val();
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
                  }
              });
            });

            $(document).on('click', '#edit-kelas',function (e) {
              var kelas = $(this).data('kelas');
              var id_kelas = $(this).data('id');
              swal.fire({
                  title: "Edit",
                  html: '<br><input class="form-control" placeholder="input2" value="'+kelas+'" id="nama_kelas" required>',
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
                          data: JSON.stringify({ idKelas: id_kelas, namaKelas: nama_kelas}),
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
                  }
              });
            });
             $("#form-siswa").click(function (e) {
              swal.fire({
                  title: "Tambah Siswa",
                  html: '<br><input class="form-control" placeholder="NISN" id="nisn">'+
                        '<br><input class="form-control" placeholder="Nama Siswa" id="nm_siswa">'+
                        '<br><input class="form-control" placeholder="Tahun Masuk" id="tahun_masuk">'+
                        '<br><input class="form-control" placeholder="Username" id="username">'+
                        '<br><input class="form-control" placeholder="Password" id="password">',
                  showCancelButton: true,
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: true,
              }).then((result) => {
                  if (result.isConfirmed) {
                      var nisn = $("#nisn").val();
                      var nm_siswa = $("#nm_siswa").val();
                      var tahun_masuk = $("#tahun_masuk").val();
                      var user = $("#username").val();
                      var pass = $("#password").val();
                      
                      $.ajax({
                          url: '<?= url("/admin/kelas-siswa.php")?>',
                          type: 'POST',
                          data: {
                            idUser: nisn,
                            idKelas: id,
                            nmSiswa: nm_siswa,
                            tahunMasuk: tahun_masuk,
                            username: user,
                            password: pass
                          },
                          success: function(data, textStatus, xhr) {
                            console.log(data);
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
                  }
              });
            });    
            $("#tahun-ajar").on('change', function() {
              var tahun_ajaran = this.value;
              $.ajax({
                url: '<?= url("/admin/kelas-siswa.php")?>',
                type: 'PUT',
                data: JSON.stringify({ idKelas: id, tahunAjaran: tahun_ajaran }),
                success: function(data, textStatus, xhr) {
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
            });
            $(document).on('click', '#del-kelas',function (e) {
              var id_kelas = $(this).data('id');
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
                    url: '<?= url("/admin/do-kelas.php")?>',
                    type: 'DELETE',
                    data: JSON.stringify({ idKelas: id_kelas}),
                    success: function(data, textStatus, xhr) {
                    console.log(data);
                    swal.fire({
                      title: "",
                      text: "Kelas Terhapus",
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