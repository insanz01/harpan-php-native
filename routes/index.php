<?php
  session_start();
  
  $is_login = false;

  if(isset($_GET["type"])) {
    if($_GET["type"] == "laporan") {
      $page = $_GET["page"];

      switch($page) {
        case "laporan-harga-eceran":
          include "pages/admin/laporan/harga-eceran.php";
          break;
        case "laporan-harga-grosir":
          include "pages/admin/laporan/harga-grosir.php";
          break;
        case "laporan-harga-nasional":
          include "pages/admin/laporan/harga-nasional.php";
          break;
        case "laporan-harga-distributor":
          include "pages/admin/laporan/harga-distributor.php";
          break;
        case "laporan-harga-produsen":
          include "pages/admin/laporan/harga-produsen.php";
          break;
        case "laporan-stok":
          include "pages/admin/laporan/stok.php";
          break;
        case "laporan-permintaan":
          include "pages/admin/laporan/permintaan.php";
          break;
        case "laporan-inflasi":
          include "pages/admin/laporan/inflasi.php";
          break;
        case "laporan-kritik-saran":
          include "pages/admin/laporan/kritik-saran.php";
          break;
      }
    }
  } else {
    if(isset($_GET["page"])) {
      if($_GET["page"] == "logout") {
        session_destroy();
        header("location:index.php");
      }
  
      if($_GET["page"] == "login") {
        include "pages/auth/login.php";
        $is_login = true;
      }

      if($_GET["page"] == "register") {
        include "pages/auth/registrasi.php";
        $is_login = true;
      }
  
      if($_GET["page"] == "login-pimpinan") {
        include "pages/auth/pimpinan/login.php";
        $is_login = true;
      }
  
      if($_GET["page"] == "login-administrator") {
        include "pages/auth/admin/login.php";
        $is_login = true;
      }
    }
    
    if(!$is_login) {
      if(empty($_SESSION["SESS_HARPAN_LOGIN"])) {
        // include "pages/auth/login.php";
        include "partials/header.php";
        include "partials/topbar.php";
        include "partials/sidebar.php";
        include "routes.php";
        include "partials/footer.php";
      } else {
        if($_SESSION["SESS_HARPAN_LOGIN"] == true) {
          include "partials/header.php";
          include "partials/topbar.php";
          include "partials/sidebar.php";
          include "routes.php";
          include "partials/footer.php";
        }
      }
    }
  }


?>