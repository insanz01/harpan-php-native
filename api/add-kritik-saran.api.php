<?php

session_start();

include "../helper/helper.php";
include "../helper/validate.php";
include "../database/db.php";

$kritik_saran = validate_input($connection, $_POST["kritik_saran"]);
$nama = validate_input($connection, $_POST["nama"]);
$alamat = validate_input($connection, $_POST["alamat"]);
$email = validate_input($connection, $_POST["email"]);
$no_hp = validate_input($connection, $_POST["no_hp"]);

$query = "INSERT INTO kritik_saran (nama, alamat, email, no_hp, pesan) VALUES ('$nama', '$alamat', '$email', '$no_hp', '$kritik_saran')";

$result = mysqli_query($connection, $query);

$data = null;

if($result) {
  $data['pesan'] = $kritik_saran;
  $data['created_at'] = date('Y-m-d H:i:s');

  to_json($data);
  return;
}

to_json($data, false, "can't insert value");