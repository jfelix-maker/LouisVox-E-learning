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
    if(!isset($_GET['kl'])&&!isset($_GET['dtl'])){
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
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-home">
                  Materi
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
                        <h4 class="card-title">Form Materi</h4>
                      <?php
                        }else{
                      ?>
                        <h4 class="card-tools">Form Edit Materi</h4>
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
                          <form action="do-materi.php" method="POST" class="form-group" enctype="multipart/form-data">
                            <input type="hidden" name="id_kelas" value="<?= $id; ?>"/>                            
                            <label>Judul Materi</label>
                            <input type="text" class="form-control" name="nm_materi" placeholder="Judul Materi" required>
                            <label>PDF</label>
                            <input type="file" class="form-control" name="dok" placeholder="PDF" required>
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
                              $raw = ($conn->query("SELECT * FROM tbmateri WHERE id_materi = '$dtl';"))->fetch_assoc();
                          ?>
                            <form action="do-materi.php" method="POST" class="form-group" enctype="multipart/form-data">
                              <input type="hidden" name="PUT" value="<?= $dtl; ?>"/>
                              <input type="hidden" name="id_kelas" value="<?= $id; ?>"/>                            
                              <label>Judul Materi</label>
                              <input type="text" class="form-control" value="<?= $raw['nm_materi']; ?>" name="nm_materi" placeholder="Judul Materi" required>
                              <label>PDF</label>
                              <input type="file" class="form-control" name="dok" placeholder="PDF">
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
                    <div class="card-title">Data Materi Kelas <?= $dk['nm_kelas']; ?></div>
                  </div>
                  <div class="card-body">
                    <div class="col-md-12">
                    </div>
                  <table class="table table-hover">
                    <thead> 
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Materi</th>
                          <th scope="col">PDF</th>
                          <th scope="col" colspan="2">Aksi</th>
                        </tr>    
                    </thead>
                    <tbody>
                    <?php
                      $query = $conn->query("SELECT * FROM tbmateri tm, tbmapeldtl tmd WHERE tm.id_mapel_dtl = tmd.id_mapel_dtl AND tmd.id_guru =  '$id_guru' AND tmd.id_kelas = '$id'");
                      $i = 1;
                      while($data = $query->fetch_assoc()){
                    ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $data['nm_materi']; ?></td>
                        <td><a <?= ($data['dokumen'] == "")? "" : "href='".$data['dokumen']."'"; ?> target="_blank"><?= ($data['dokumen'] == "")? "Kosong" : "Ada"; ?></td>
                        <td><a href="<?= url("/guru/materi.php?kl=".$id."&dtl=".$data['id_materi']); ?>" class="btn btn-warning"> Edit</a></td>
                        <td><button
                        type="button"
                        class="btn btn-danger"
                        id="del-materi"
                        data-id="<?= $data['id_materi']; ?>">
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

    <script src="../assets/js/main.min.js"></script>

    <script>
    var SweetAlert2Demo = (function () {
        var initDemos = function () {
            $(document).on('click', '#del-materi',function (e) {   
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
                    url: '<?= url("/admin/do-mata-pelajaran.php")?>',
                    type: 'DELETE',
                    data: JSON.stringify({ idMapel: id}),
                    success: function(data, textStatus, xhr) {
                    console.log(data);
                    swal.fire({
                      title: "",
                      text: "Mata Pelajaran Terhapus",
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
