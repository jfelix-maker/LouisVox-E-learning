<?php 
session_start();
if (!isset($_SESSION['user']) || $_SESSION['level'] != 3) {
    header("Location: ../index.php");
    exit;
}
$username = $_SESSION['user'];

require_once "../config.php";
$sql = "SELECT tmapel.nm_mapel 
        FROM tbsiswa tsiswa 
        JOIN tbkelas tkelas ON tsiswa.id_kelas = tkelas.id_kelas 
        JOIN tbmapel tmapel ON tsiswa.tahun_ajaran = tmapel.id_tahunajaran
        WHERE tsiswa.nm_siswa = '$username'";

$result = $conn->query($sql);
$mapelArray = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mapelArray[] = $row['nm_mapel'];
    }
} else {
}
$conn->close();
?>

<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <div class="logo-header" data-background-color="dark">
      <a href="/admin/" class="logo">
        <img
          src="../assets/img/sekolah/logo.svg"
          alt="navbar brand"
          class="navbar-brand"
          height="70"
        />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item <?= ($menu == 'index') ? 'active' : ''; ?>">
          <a href="<?= url('/siswa'); ?>">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Menu Utama</h4>
        </li>
        <li class="nav-item <?= ($menu == 'Materi') ? 'active' : ''; ?>">
          <a data-bs-toggle="collapse" href="#kelasDropdown" aria-expanded="false">
            <i class="fas fa-book"></i>
            <p>Materi</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="kelasDropdown">
            <ul class="nav nav-collapse">
              <?php 
              if (!empty($mapelArray)): 
                  foreach ($mapelArray as $mapel): 
              ?>
              <li>
                <a href="<?= url('/siswa/' . strtolower(str_replace(' ', '_', $mapel)) . '.php'); ?>">
                  <span class="sub-item"><?= $mapel; ?></span>
                </a>
              </li>
              <?php 
                  endforeach;
              else:
                  echo "<li><span class='sub-item'>Tidak ada mata pelajaran tersedia.</span></li>";
              endif;
              ?>
            </ul>
          </div>
        </li>
        <li class="nav-item <?= ($menu == 'Tugas') ? 'active' : ''; ?>">
          <a data-bs-toggle="collapse" href="#tugasDropdown" aria-expanded="false">
            <i class="fas fa-tasks"></i>
            <p>Tugas</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tugasDropdown">
            <ul class="nav nav-collapse">
              <?php foreach ($mapelArray as $mapel): ?>
              <li>
                <a href="<?= url('/siswa/tugas.php'); ?>">
                  <span class="sub-item"><?= $mapel; ?></span>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </li>
        <li class="nav-item <?= ($menu == 'Quiz') ? 'active' : ''; ?>">
          <a data-bs-toggle="collapse" href="#quizDropdown" aria-expanded="false">
            <i class="fas fa-question-circle"></i>
            <p>Quiz</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="quizDropdown">
            <ul class="nav nav-collapse">
              <?php foreach ($mapelArray as $mapel): ?>
              <li>
                <a href="<?= url('/siswa/kuis.php'); ?>">
                  <span class="sub-item"><?= $mapel; ?></span>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </li>
        <li class="nav-item <?= ($menu == 'Ujian') ? 'active' : ''; ?>">
          <a data-bs-toggle="collapse" href="#ujianDropdown" aria-expanded="false" aria-controls="ujianDropdown">
            <i class="fas fa-pencil-alt"></i>
            <p>Ujian</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="ujianDropdown">
            <ul class="nav nav-collapse">
              <?php foreach ($mapelArray as $mapel): ?>
              <li>
                <a href="<?= url('/siswa/ujian.php'); ?>">
                  <span class="sub-item"><?= $mapel; ?></span>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </li>
        <li class="nav-item <?= ($menu == 'Nilai') ? 'active' : ''; ?>">
          <a href="<?= url('/siswa/nilai.php'); ?>">
            <i class="fas fa-chart-bar"></i>
            <p>Nilai</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll('.collapse');

    dropdowns.forEach(function(dropdown) {
      dropdown.addEventListener('show.bs.collapse', function() {
        dropdowns.forEach(function(otherDropdown) {
          if (otherDropdown !== dropdown && otherDropdown.classList.contains('show')) {
            otherDropdown.classList.remove('show');
          }
        });
      });
    });
  });
</script>