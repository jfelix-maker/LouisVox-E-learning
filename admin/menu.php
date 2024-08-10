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
                <a href="<?= url("/admin"); ?>">
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
                <a href="<?= url("/admin/kelas.php"); ?>">
                  <i class="fas fa-users"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#guru">
                  <i class="fas fa-user-tie"></i>
                  <p>Guru</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="guru">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?= url("/admin/guru.php"); ?>">
                        <span class="sub-item">Data Guru</span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="sub-item">Data Mata Pelajaran</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item <?= ($menu == "siswa") ? "active" : ""; ?>">
                <a href="<?= url("/admin/siswa.php"); ?>">
                  <i class="fas fa-user-graduate"></i>
                  <p>Siswa</p>
                </a>
              </li>              
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->