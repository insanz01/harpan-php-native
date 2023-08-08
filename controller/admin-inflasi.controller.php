<?php

include "helper/helper.php";
include_once "database/db.php";

$query = "SELECT inflasi.id, inflasi.id_komoditas, komoditas.nama, inflasi.nominal, komoditas.satuan, inflasi.nilai, inflasi.created_at, inflasi.updated_at FROM inflasi JOIN komoditas ON komoditas.id = inflasi.id_komoditas WHERE inflasi.deleted_at is NULL ORDER BY created_at DESC";

$result = mysqli_query($connection, $query);

$data = [];

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $hargaNasionalQuery = "SELECT * FROM harga_nasional WHERE id_komoditas = $row[id_komoditas] ORDER BY created_at DESC LIMIT 1";

    $hargaNasionalResult = mysqli_query($connection, $hargaNasionalQuery);

    $harga = 0;
    if($hargaNasionalResult) {
      $r = mysqli_fetch_assoc($hargaNasionalResult);

      if($r) {
        $harga = $r['harga'];
      }
    }

    $temp_data = [
      "id" => $row['id'],
      "nama" => $row['nama'],
      "nominal" => $row['nominal'],
      "nilai" => $row['nilai'],
      "satuan" => $row['satuan'],
      "harga_lama" => $harga,
      "harga_baru" => $harga + ($harga * ($row['nominal'] / 100)),
      "created_at" => $row['created_at'],
      "updated_at" => $row['updated_at']
    ];

    array_push($data, $temp_data);
  }
}
