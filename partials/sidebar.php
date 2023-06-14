<?php
  // session_start();
  $role_id = 0;
  $role_name = "Publik";

  if(isset($_SESSION["SESS_HARPAN_ROLE_ID"])) {
    $role_id = $_SESSION["SESS_HARPAN_ROLE_ID"];
    $role_name = $_SESSION["SESS_HARPAN_ROLE"];
  }
?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DEMO PROGRESS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $role_name ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if($role_id == 0): ?>
            <!-- <li class="nav-item">
              <a href="?page=harga-publik" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>
                  Dashboard
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=harga-eceran-publik" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Harga Eceran</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=harga-grosir-publik" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Harga Grosir</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=harga-nasional-publik" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Harga Nasional</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="?page=stok-publik" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Data Stok
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=agenda-publik" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Agenda Pasar Murah
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
                <p>
                  Login
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=login-administrator" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Login Administrator</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=login-pimpinan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Login Pimpinan</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="nav-item">
              <a href="?page=login" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Login
                </p>
              </a>
            </li> -->
          <?php endif; ?>

          <?php if($role_id != 0): ?>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-header">MASTER DATA HARGA</li>
            <li class="nav-item">
              <a href="?page=eceran" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Harga Eceran
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Harga Grosir
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Harga Nasional
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Harga Distributor
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>

            <li class="nav-header">MASTER DATA</li>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Stok
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Permintaan
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Inflasi
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>

            <?php if($role_id == 1): ?>
              <li class="nav-header">BAGIAN PIMPINAN</li>
              <li class="nav-item">
                <a href="?page=dashboard" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Verifikasi Data
                    <!-- <span class="right badge badge-danger">New</span> -->
                  </p>
                </a>
              </li>
            <?php endif; ?>

            <li class="nav-header">LAINNYA</li>
            <li class="nav-item">
              <a href="?page=logout" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Keluar
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
          <?php endif; ?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">