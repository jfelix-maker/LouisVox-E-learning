<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['level'] != 2) {
    header("Location: ../index.php");
    exit;
}
$id_guru = $_SESSION['uid'];
?>
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
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
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item <?= ($menu == "index") ? "active" : ""; ?>">
                <a href="<?= url("/guru/"); ?>">
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
              <li class="nav-item <?= ($menu == "kelas") ? "active" : ""; ?>">
                <a data-bs-toggle="collapse" href="#kelas">
                  <i class="fas fa-users"></i>
                  <p>Kelas</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="kelas">
                  <ul class="nav nav-collapse">
                    <?php
                    $id_guru = $_SESSION['uid'];
                    $qgk = $conn->query("SELECT * FROM tbmapeldtl tmd, tbkelas tk WHERE tmd.id_guru = '$id_guru' AND tk.id_kelas = tmd.id_kelas");
                    while($dgk = $qgk->fetch_assoc()){
                    ?>
                    <li>
                      <a href="<?= url("/guru/kelas.php?kl=".$dgk['id_kelas']); ?>">
                        <span class="sub-item"><?= $dgk['nm_kelas']; ?></span>
                      </a>
                    </li>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
              </li>            
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->