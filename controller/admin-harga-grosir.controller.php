<?php

include_once "database/db.php";

$filter_tanggal = date("Y-m-d");
if(isset($_POST["filter_tanggal"])) {
  $filter_tanggal = $_POST["filter_tanggal"];
}

$filter_tgl_mulai = null;
$filter_tgl_selesai = null;
if(isset($_POST["tgl_mulai"]) && isset($_POST["tgl_selesai"])) {
  $filter_tgl_mulai = $_POST["tgl_mulai"];
  $filter_tgl_selesai = $_POST["tgl_selesai"];
}

$week_dates = array();

$currentWeekQuery = "SELECT WEEK(NOW()) as week";
if($filter_tanggal) {
  $currentWeekQuery = "SELECT WEEK($filter_tanggal) as week";
}

$resultWeek = mysqli_query($connection, $currentWeekQuery);
$currentWeek = 0;
if($resultWeek->num_rows > 0) {
  $currentWeek = $resultWeek->fetch_assoc();
  $currentWeek = $currentWeek["week"];
}

$currentDate = date("Y-m-d", strtotime($filter_tanggal));

$dayOfWeek = date("N", strtotime($currentDate)); // 1 (Senin) hingga 7 (Minggu)

$firstDateOfWeek = date("Y-m-d", strtotime("-" . ($dayOfWeek - 1) . " days", strtotime($currentDate)));
$lastDateOfWeek = date("Y-m-d", strtotime("+" . (7 - $dayOfWeek) . " days", strtotime($currentDate)));

if($filter_tgl_mulai && $filter_tgl_selesai) {
  $firstDateOfWeek = $filter_tgl_mulai;
  $lastDateOfWeek = $filter_tgl_selesai;
}

$start_date = strtotime($firstDateOfWeek);
$end_date = strtotime($lastDateOfWeek);

$current_date = $start_date;
while ($current_date <= $end_date) {
  array_push($week_dates, date("Y-m-d", $current_date));
  $current_date = strtotime("+1 day", $current_date);
}

$week_datas = array();
$week_data = array();

$queryKomoditas = "SELECT id, nama FROM komoditas WHERE deleted_at is null";
$resultKomoditas = mysqli_query($connection, $queryKomoditas);

if(mysqli_num_rows($resultKomoditas) > 0) {
  while($row = mysqli_fetch_assoc($resultKomoditas)) {
    
    $week_data = [];

    array_push($week_data, $row["nama"]);

    foreach($week_dates as $date) {
      $queryPermintaan = "SELECT h.id, h.id_komoditas, k.nama, h.harga, h.created_at FROM harga_grosir h JOIN komoditas k ON h.id_komoditas = k.id WHERE DATE(h.created_at) = '$date' AND h.id_komoditas = $row[id]";

      $resultPermintaan = mysqli_query($connection, $queryPermintaan);

      $total_harga = 0;
      if($resultPermintaan->num_rows > 0) {
        $permintaan = $resultPermintaan->fetch_assoc();
        $total_harga = $permintaan["harga"];
      }

      array_push($week_data, $total_harga);
    }
    
    array_push($week_datas, $week_data);
  }
}

// var_dump($currentWeek);
// var_dump($week_datas);