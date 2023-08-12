<?php
  $page = "";
  $action = "";
  if(isset($_GET["page"])) {
    $page = $_GET["page"];
  }

  if(isset($_GET["action"])) {
    $action = $_GET["action"];
  }

  switch($page) {
    case "dashboard":
      if(empty($_SESSION["SESS_HARPAN_LOGIN"])) {
        include "pages/public/index.php";
      } else {
        include "pages/admin/index.php";
      }
      break;
    case "kontak-kami":
      include "pages/public/kontak.php";
      break;
    case "harga-publik":
      include "pages/public/index.php";
      break;
    case "harga-eceran-publik":
      include "pages/public/harga/eceran.php";
      break;
    case "harga-grosir-publik":
      include "pages/public/harga/grosir.php";
      break;
    case "harga-nasional-publik":
      include "pages/public/harga/nasional.php";
      break;
    case "stok-publik":
      include "pages/public/stok.php";
      break;
    case "agenda-publik":
      include "pages/public/agenda.php";
      break;
    case "kritik-saran":
      include "pages/admin/kritik_saran/index.php";
      break;
    case "komoditas":
      if($action == "tambah") {
        include "pages/admin/komoditas/tambah.php";
      } else if($action == "edit") {
        if(isset($_GET["id"])) {
          $id = $_GET["id"];
          
          include "pages/admin/komoditas/edit.php";
        } else {
          include "pages/admin/komoditas/index.php";
        }
      } else {
        include "pages/admin/komoditas/index.php";
      }
      break;
    case "eceran":
      if($action == "tambah") {
        include "pages/admin/harga/eceran/tambah.php";
      } else if($action == "edit") {
        if(isset($_GET["id"])) {
          // $_GET["id"];
          
          include "pages/admin/harga/eceran/edit.php";
        } else {
          include "pages/admin/harga/eceran/index.php";
        }
      } else if($action == "print") {
        include "pages/admin/harga/eceran/print.php";
      } else {
        include "pages/admin/harga/eceran/index.php";
      }
      break;
    case "grosir":
      if($action == "tambah") {
        include "pages/admin/harga/grosir/tambah.php";
      } else if($action == "edit") {
        if(isset($_GET["id"])) {
          $id = $_GET["id"];
          
          include "pages/admin/harga/grosir/edit.php";
        } else {
          include "pages/admin/harga/grosir/index.php";
        }
      } else if($action == "print") {
        include "pages/admin/harga/grosir/print.php";
      } else {
        include "pages/admin/harga/grosir/index.php";
      }
      break;
    case "nasional":
      if($action == "tambah") {
        include "pages/admin/harga/nasional/tambah.php";
      } else if($action == "edit") {
        if(isset($_GET["id"])) {
          $id = $_GET["id"];
          
          include "pages/admin/harga/nasional/edit.php";
        } else {
          include "pages/admin/harga/nasional/index.php";
        }
      }  else if($action == "print") {
        include "pages/admin/harga/nasional/print.php";
      } else {
        include "pages/admin/harga/nasional/index.php";
      }
      break;
    case "distributor":
      if($action == "tambah") {
        include "pages/admin/harga/distributor/tambah.php";
      } else if($action == "edit") {
        if(isset($_GET["id"])) {
          $id = $_GET["id"];
          
          include "pages/admin/harga/distributor/edit.php";
        } else {
          include "pages/admin/harga/distributor/index.php";
        }
      } else if($action == "print") {
        include "pages/admin/harga/distributor/print.php";
      } else {
        include "pages/admin/harga/distributor/index.php";
      }
      break;
    case "produsen":
      if($action == "tambah") {
        include "pages/admin/harga/produsen/tambah.php";
      } else if($action == "edit") {
        if(isset($_GET["id"])) {
          $id = $_GET["id"];
          
          include "pages/admin/harga/produsen/edit.php";
        } else {
          include "pages/admin/harga/produsen/index.php";
        }
      } else if($action == "print") {
        include "pages/admin/harga/produsen/print.php";
      } else {
        include "pages/admin/harga/produsen/index.php";
      }
      break;
    case "stok":
      if($action == "tambah") {
        include "pages/admin/stok/tambah.php";
      } else if($action == "edit") {
        $id = $_GET["id"];

        include "pages/admin/stok/edit.php";
      } else {
        include "pages/admin/stok/index.php";
      }
      break;
    case "permintaan":
      if($action == "tambah") {
        include "pages/admin/permintaan/tambah.php";
      } else if($action == "edit") {
        $id = $_GET["id"];

        include "pages/admin/permintaan/edit.php";
      } else {
        include "pages/admin/permintaan/index.php";

      }
      break;
    case "inflasi":
      if($action == "tambah") {
        include "pages/admin/inflasi/tambah.php";
      } else if($action == "edit") {
        $id = $_GET["id"];

        include "pages/admin/inflasi/edit.php";
      } else {
        include "pages/admin/inflasi/index.php";

      } 
      break;
    case "aktifasi":
      include "pages/pimpinan/aktifasi/index.php";
      break;
    case "satuan":
      if($action == "tambah") {
        include "pages/admin/satuan/tambah.php";
      } else if($action == "edit") {
        $id = $_GET["id"];

        include "pages/admin/satuan/edit.php";
      } else {
        include "pages/admin/satuan/index.php";
      }
      break;
    case "admin-agenda":
      if($action == "tambah") {
        include "pages/admin/agenda/tambah.php";
      } else if($action == "edit") {
        $id = $_GET["id"];

        include "pages/admin/agenda/edit.php";
      } else {
        include "pages/admin/agenda/index.php";
      }
      break;
    default:
      if(empty($_SESSION["SESS_HARPAN_LOGIN"])) {
        include "pages/public/index.php";
      } else {
        include "pages/admin/index.php";
      }
  }

?>