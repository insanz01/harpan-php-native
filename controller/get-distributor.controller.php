<?php

include_once "helper/helper.php";
include_once "database/db.php";

$query = "SELECT harga_distributor.id, harga_distributor.harga, komoditas.satuan, komoditas.id as id_komoditas, komoditas.nama as komoditas, harga_distributor.created_at, harga_distributor.approved_at, harga_distributor.updated_at FROM harga_distributor JOIN komoditas ON harga_distributor.id_komoditas = komoditas.id WHERE harga_distributor.deleted_at is NULL ORDER BY harga_distributor.created_at DESC";

if(isset($_GET["id"])) {
  $id = $_GET["id"];

  $query = "SELECT harga_distributor.id, harga_distributor.harga, komoditas.satuan, komoditas.id as id_komoditas, komoditas.nama as komoditas, harga_distributor.approved_at, harga_distributor.created_at, harga_distributor.updated_at FROM harga_distributor JOIN komoditas ON harga_distributor.id_komoditas = komoditas.id WHERE harga_distributor.deleted_at is NULL AND harga_distributor.id = $id ORDER BY harga_distributor.created_at DESC";
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
