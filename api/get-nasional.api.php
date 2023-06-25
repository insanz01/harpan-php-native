<?php

include "../helper/helper.php";
include "../database/db.php";

$query = "SELECT harga_nasional.id, harga_nasional.harga, komoditas.nama as komoditas, harga_nasional.approved_at, harga_nasional.created_at, harga_nasional.updated_at FROM harga_nasional JOIN komoditas ON harga_nasional.id_komoditas = komoditas.id WHERE harga_nasional.deleted_at is NULL";

if(isset($_GET["id"])) {
  $id = $_GET["id"];

  $query = "SELECT harga_nasional.id, harga_nasional.harga, komoditas.nama as komoditas, harga_nasional.approved_at, harga_nasional.created_at, harga_nasional.updated_at FROM harga_nasional JOIN komoditas ON harga_nasional.id_komoditas = komoditas.id WHERE harga_nasional.deleted_at is NULL AND harga_nasional.id = $id";
}

$result = mysqli_query($connection, $query);

$data = [];

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $temp_data = [
      "id" => $row['id'],
      "komoditas" => $row['komoditas'],
      "harga" => $row['harga'],
      "approved_at" => $row['approved_at'],
      "created_at" => $row['created_at'],
      "updated_at" => $row['updated_at']
    ];

    array_push($data, $temp_data);
  }
}

to_json($data);
