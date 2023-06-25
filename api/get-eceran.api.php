<?php

include "../helper/helper.php";
include "../database/db.php";

$query = "SELECT harga_eceran.id, harga_eceran.harga, komoditas.nama as komoditas, komoditas.id as id_komoditas, satuan.nama as satuan, harga_eceran.approved_at, harga_eceran.created_at, harga_eceran.updated_at FROM harga_eceran JOIN komoditas ON harga_eceran.id_komoditas = komoditas.id JOIN satuan ON komoditas.id_satuan = satuan.id WHERE harga_eceran.deleted_at is NULL";

if(isset($_GET["id"])) {
  $id = $_GET["id"];

  $query = "SELECT harga_eceran.id, harga_eceran.harga, komoditas.nama as komoditas, komoditas.id as id_komoditas, satuan.nama as satuan, harga_eceran.approved_at, harga_eceran.created_at, harga_eceran.updated_at FROM harga_eceran JOIN komoditas ON harga_eceran.id_komoditas = komoditas.id JOIN satuan ON komoditas.id_satuan = satuan.id WHERE harga_eceran.deleted_at is NULL AND harga_eceran.id = $id";
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

to_json($data);
