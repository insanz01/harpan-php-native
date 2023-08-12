<?php

include_once "helper/helper.php";
include_once "database/db.php";

$query = "SELECT harga_nasional.id, harga_nasional.harga, komoditas.id as id_komoditas, komoditas.nama as komoditas, komoditas.satuan, harga_nasional.approved_at, harga_nasional.created_at, harga_nasional.updated_at FROM harga_nasional JOIN komoditas ON harga_nasional.id_komoditas = komoditas.id WHERE harga_nasional.deleted_at is NULL AND harga_nasional.approved_at is not null ORDER BY harga_nasional.created_at DESC";

if(isset($_GET["id"])) {
  $id = $_GET["id"];

  $query = "SELECT harga_nasional.id, harga_nasional.harga, komoditas.id as id_komoditas, komoditas.nama as komoditas, komoditas.satuan, harga_nasional.approved_at, harga_nasional.created_at, harga_nasional.updated_at FROM harga_nasional JOIN komoditas ON harga_nasional.id_komoditas = komoditas.id JOIN satuan ON komoditas.id_satuan = satuan.id WHERE harga_nasional.deleted_at is NULL AND harga_nasional.approved_at is not null AND harga_nasional.id = $id ORDER BY harga_nasional.created_at DESC";
}

$result = mysqli_query($connection, $query);

$data = [];

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $temp_data = [
      "id" => $row['id'],
      "id_komoditas" => $row['id_komoditas'],
      "nama" => $row['komoditas'],
      "harga" => $row['harga'],
      "satuan" => $row['satuan'],
      "approved_at" => $row['approved_at'],
      "created_at" => $row['created_at'],
      "updated_at" => $row['updated_at']
    ];

    array_push($data, $temp_data);
  }
}
