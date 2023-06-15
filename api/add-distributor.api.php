<?php

session_start();

include "../helper/helper.php";
include "../helper/validate.php";
include "../database/db.php";

$id_komoditas = validate_input($connection, $_POST["id_komoditas"]);
$harga = validate_input($connection, $_POST["harga"]);
$tanggal = validate_input($connection, $_POST["tanggal"]);

$query = "INSERT INTO harga_distributor (id_komoditas, harga) VALUES ('$id_komoditas', $harga)";

$result = mysqli_query($connection, $query);

$data = null;

if ($result) {
  $data['id_komoditas'] = $id_komoditas;
  $data['harga'] = $harga;
  $data['created_at'] = $tanggal;
  
  to_json($data);
  return;
}

to_json($data, false, "can't insert value");

