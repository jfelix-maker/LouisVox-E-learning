<!DOCTYPE html>
<html lang="id">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>E-Learning</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/sekolah/favicon.ico" type="image/x-icon" />

    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
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
    <?php require '../config.php'; ?>
    <div class="wrapper">
      <?php $menu = "kelas"; require 'menu.php'; ?>

      <div class="main-panel">
        <?php require 'header.php'; ?>
        <div class="container">
          <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
              <div class="page-header">
                <h3 class="fw-bold mb-3">Penilaian Mata Pelajaran</h3>
              </div>
            </div>
            <div class="filters mb-3">
              <div class="row">
                <div class="col-md-4">
                  <label for="filter-subject">Mata Pelajaran</label>
                  <select id="filter-subject" class="form-control">
                    <option value="">Semua</option>
                    <option value="Matematika">Matematika</option>
                    <option value="Ilmu Pengetahuan Alam">Ilmu Pengetahuan Alam</option>
                    <option value="Sejarah">Sejarah</option>
                    <option value="Geografi">Geografi</option>
                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                    <option value="Ekonomi">Ekonomi</option>
                    <option value="Biologi">Biologi</option>
                    <option value="Fisika">Fisika</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="filter-category">Kategori</label>
                  <select id="filter-category" class="form-control">
                    <option value="">Semua</option>
                    <option value="Tugas">Tugas</option>
                    <option value="Kuis">Kuis</option>
                    <option value="Ujian">Ujian</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="filter-year">Tahun</label>
                  <select id="filter-year" class="form-control">
                    <option value="">Semua</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Data Penilaian</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="assessment-datatables" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Mata Pelajaran</th>
                            <th>Kategori</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data Contoh -->
                          <tr>
                            <td>Matematika</td>
                            <td>Tugas</td>
                            <td>85</td>
                            <td>2024/08/01</td>
                          </tr>
                          <tr>
                            <td>Ilmu Pengetahuan Alam</td>
                            <td>Kuis</td>
                            <td>90</td>
                            <td>2024/08/02</td>
                          </tr>
                          <tr>
                            <td>Sejarah</td>
                            <td>Ujian</td>
                            <td>78</td>
                            <td>2024/08/03</td>
                          </tr>
                          <tr>
                            <td>Geografi</td>
                            <td>Tugas</td>
                            <td>88</td>
                            <td>2024/08/04</td>
                          </tr>
                          <tr>
                            <td>Bahasa Inggris</td>
                            <td>Kuis</td>
                            <td>92</td>
                            <td>2024/08/05</td>
                          </tr>
                          <tr>
                            <td>Ekonomi</td>
                            <td>Tugas</td>
                            <td>80</td>
                            <td>2024/08/06</td>
                          </tr>
                          <tr>
                            <td>Biologi</td>
                            <td>Kuis</td>
                            <td>85</td>
                            <td>2024/08/07</td>
                          </tr>
                          <tr>
                            <td>Fisika</td>
                            <td>Ujian</td>
                            <td>77</td>
                            <td>2024/08/08</td>
                          </tr>
                          <!-- Data Tambahan -->
                          <tr>
                            <td>Matematika</td>
                            <td>Kuis</td>
                            <td>91</td>
                            <td>2024/08/09</td>
                          </tr>
                          <tr>
                            <td>Ilmu Pengetahuan Alam</td>
                            <td>Tugas</td>
                            <td>84</td>
                            <td>2024/08/10</td>
                          </tr>
                          <tr>
                            <td>Sejarah</td>
                            <td>Kuis</td>
                            <td>80</td>
                            <td>2024/08/11</td>
                          </tr>
                          <tr>
                            <td>Geografi</td>
                            <td>Ujian</td>
                            <td>89</td>
                            <td>2024/08/12</td>
                          </tr>
                          <tr>
                            <td>Bahasa Inggris</td>
                            <td>Tugas</td>
                            <td>87</td>
                            <td>2024/08/13</td>
                          </tr>
                          <tr>
                            <td>Ekonomi</td>
                            <td>Kuis</td>
                            <td>79</td>
                            <td>2024/08/14</td>
                          </tr>
                          <tr>
                            <td>Biologi</td>
                            <td>Ujian</td>
                            <td>86</td>
                            <td>2024/08/15</td>
                          </tr>
                          <tr>
                            <td>Fisika</td>
                            <td>Tugas</td>
                            <td>82</td>
                            <td>2024/08/16</td>
                          </tr>
                          <tr>
                            <td>Matematika</td>
                            <td>Ujian</td>
                            <td>90</td>
                            <td>2024/08/17</td>
                          </tr>
                          <tr>
                            <td>Ilmu Pengetahuan Alam</td>
                            <td>Tugas</td>
                            <td>88</td>
                            <td>2024/08/18</td>
                          </tr>
                          <tr>
                            <td>Sejarah</td>
                            <td>Kuis</td>
                            <td>85</td>
                            <td>2024/08/19</td>
                          </tr>
                          <tr>
                            <td>Geografi</td>
                            <td>Ujian</td>
                            <td>87</td>
                            <td>2024/08/20</td>
                          </tr>
                          <tr>
                            <td>Bahasa Inggris</td>
                            <td>Tugas</td>
                            <td>91</td>
                            <td>2024/08/21</td>
                          </tr>
                          <tr>
                            <td>Ekonomi</td>
                            <td>Kuis</td>
                            <td>84</td>
                            <td>2024/08/22</td>
                          </tr>
                          <tr>
                            <td>Biologi</td>
                            <td>Ujian</td>
                            <td>80</td>
                            <td>2024/08/23</td>
                          </tr>
                          <tr>
                            <td>Fisika</td>
                            <td>Tugas</td>
                            <td>87</td>
                            <td>2024/08/24</td>
                          </tr>
                          <tr>
                            <td>Matematika</td>
                            <td>Kuis</td>
                            <td>94</td>
                            <td>2024/08/25</td>
                          </tr>
                          <tr>
                            <td>Ilmu Pengetahuan Alam</td>
                            <td>Ujian</td>
                            <td>82</td>
                            <td>2024/08/26</td>
                          </tr>
                          <tr>
                            <td>Sejarah</td>
                            <td>Tugas</td>
                            <td>77</td>
                            <td>2024/08/27</td>
                          </tr>
                          <tr>
                            <td>Geografi</td>
                            <td>Kuis</td>
                            <td>86</td>
                            <td>2024/08/28</td>
                          </tr>
                          <tr>
                            <td>Bahasa Inggris</td>
                            <td>Ujian</td>
                            <td>92</td>
                            <td>2024/08/29</td>
                          </tr>
                          <tr>
                            <td>Ekonomi</td>
                            <td>Tugas</td>
                            <td>81</td>
                            <td>2024/08/30</td>
                          </tr>
                          <tr>
                            <td>Biologi</td>
                            <td>Kuis</td>
                            <td>89</td>
                            <td>2024/08/31</td>
                          </tr>
                          <tr>
                            <td>Fisika</td>
                            <td>Ujian</td>
                            <td>78</td>
                            <td>2024/09/01</td>
                          </tr>
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
    </div>

    <!-- Core JS Files -->
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
      $(document).ready(function () {
        var table = $('#assessment-datatables').DataTable({
          "paging": true,
          "pageLength": 10,
        });

        // Filter berdasarkan Mata Pelajaran
        $('#filter-subject').on('change', function () {
          var subject = $(this).val();
          table.column(0).search(subject).draw();
        });

        // Filter berdasarkan Kategori
        $('#filter-category').on('change', function () {
          var category = $(this).val();
          table.column(1).search(category).draw();
        });

        // Filter berdasarkan Tahun
        $('#filter-year').on('change', function () {
          var year = $(this).val();
          if (year) {
            table.column(3).search('^' + year, true, false).draw(); // Regex untuk mencocokkan tahun di awal string
          } else {
            table.column(3).search('').draw();
          }
        });
      });
    </script>
  </body>
</html>
