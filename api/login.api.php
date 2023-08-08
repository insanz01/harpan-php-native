<?php

session_start();

include "../helper/helper.php";
include "../helper/validate.php";
include "../database/db.php";

$username = validate_input($connection, $_POST["username"]);
$password = $_POST["password"];
// $loginType = validate_input($connection, $_POST["loginType"]);

$query = "SELECT id, username, id_role, password FROM user WHERE username = '$username' AND aktif = 1";

$result = mysqli_query($connection, $query);

$data = null;

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  
  if(password_verify($password, $row['password'])) {
    $role_name = "";
    switch($row['id_role']) {
      case 1:
        $role_name = "Pimpinan";
        break;
      case 2:
        $role_name = "Administrator";
        break;
      case 3:
        $role_name = "Petugas";
        break;
    }

    $_SESSION['SESS_HARPAN_USERNAME'] = $username;
    $_SESSION['SESS_HARPAN_LOGIN'] = true;
    $_SESSION['SESS_HARPAN_ROLE_ID'] = $row['id_role'];
    $_SESSION['SESS_HARPAN_ROLE'] = $role_name;
  
    $data['username'] = $username;
    $data['role_id'] = $role_name;
    
    to_json($data);
    return;
  }
  // output data of each row
}

to_json($data, false, "invalid username and password");

