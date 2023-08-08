<?php
  include "config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Harga Pangan Pokok | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b></b></a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <center><img width="170px" src="dist/img/neraca.jpg"></center>
        <h1></h1>
        <p class="login-box-msg">Buat akun baru</p>

        <small id="error-msg" class="text-danger text-center"></small>

        <form action="#" onsubmit="await register(this)" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-ninja"></span>
              </div>
            </div>
          </div>
        
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" id="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          
          <div class="row">
            <input type="hidden" id="login_type" value="3">
            <!-- <div class="col-12 form-group">
              <select name="login_type" id="login_type" class="form-control">
                <option value="1">Pimpinan</option>
                <option value="2">Admin</option>
              </select>
            </div> -->
          </div>

          <div class="row">
            <div class="col-12 form-group">
              <a href="?page=login">Sudah punya akun ?</a>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="#">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="button" onclick="register()" class="btn btn-primary btn-block">Sign Up</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    const doRegister = async (data) => {
      console.log("<?= $base_url ?>/api/login.api.php");

      var bodyFormData = new FormData();

      bodyFormData.append("username", data.username);
      bodyFormData.append("password", data.password);
      bodyFormData.append("loginType", data.loginType)

      return await axios.post("<?= $base_url ?>api/register.api.php", {
        nama: data.nama,
        username: data.username,
        password: data.password,
        loginType: data.loginType
      }, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      }).then(res => res.data);
    }

    const register = async () => {
      const nama = document.getElementById("nama").value;
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      const loginType = document.getElementById('login_type').value;

      const data = {
        nama,
        username,
        password,
        loginType
      };

      const result = await doRegister(data);

      console.log(result);

      if(result.status == true) {
        console.log(result);
        window.location.href = "<?= $base_url ?>index.php?page=login";
      }
    }

    document.onkeydown = (e) => {
      if(e.code == "Enter") {
        register()
      }
    };
  </script>
</body>
</html>