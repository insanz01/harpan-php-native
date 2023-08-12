<?php

include_once "helper/helper.php";
include_once "database/db.php";

$query = "SELECT harga_produsen.id, harga_produsen.harga, komoditas.satuan, komoditas.id as id_komoditas, komoditas.nama as komoditas, harga_produsen.created_at, harga_produsen.approved_at, harga_produsen.updated_at FROM harga_produsen JOIN komoditas ON harga_produsen.id_komoditas = komoditas.id WHERE harga_produsen.deleted_at is NULL AND harga_produsen.approved_at is not NULL ORDER BY harga_produsen.created_at DESC";

if(isset($_GET["id"])) {
  $id = $_GET["id"];

  $query = "SELECT harga_produsen.id, harga_produsen.harga, komoditas.satuan, komoditas.id as id_komoditas, komoditas.nama as komoditas, harga_produsen.approved_at, harga_produsen.created_at,harga_produsen.updated_at FROM harga_produsen JOIN komoditas ON harga_produsen.id_komoditas = komoditas.id WHERE hargan_produsen.deleted_at is NULL AND harga_produsen.approved_at is not NULL AND harga_produsen.id = $id ORDER BY harga_produsen.created_at DESC";
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
