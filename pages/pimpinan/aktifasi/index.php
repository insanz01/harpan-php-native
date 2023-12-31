<?php
  include "config/config.php";
  include "controller/user.controller.php";

  $role_id = 0;
  if(isset($_SESSION["SESS_HARPAN_ROLE_ID"])) {
    $role_id = $_SESSION["SESS_HARPAN_ROLE_ID"];
  }
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Aktifasi Pengguna</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Aktifasi</a></li>
          <li class="breadcrumb-item active">User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container">

    <div class="row py-4">
      <div class="col-4">
        
      </div>
      <div class="col-4">
          
      </div>
      <div class="col-4">
        <div class="form-group">
          <!-- <a href="#" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#cetakModal">
            <i class="fas fa-fw fa-print"></i>
            Cetak
          </a> -->
          <?php if($role_id == 2): ?>
            <!-- <a href="?page=eceran&action=tambah" class="btn btn-success float-right mx-2" role="button">
              <i class="fas fa-fw fa-plus"></i>
              Tambah
            </a> -->
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12 mx-auto">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered custom-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Role User</th>
                  <th>Status</th>
                  <th class="text-right">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                  <?php $number = 1 ?>
                  <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td><?= $number++ ?></td>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['username'] ?></td>
                      <td><?= ($row['id_role'] == 1) ? 'Pimpinan' : 'Admin' ?></td>
                      <td><?= ($row['aktif'] == 1) ? 'aktif' : 'non-aktif' ?></td>
                      <td>
                        <a href="#!" class="btn btn-outline-success" role="button" onclick="changeActivation(<?= $row['id'] ?>, <?= $row['aktif'] ?>)">
                          AKTIF/NON-AKTIF
                        </a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
  const updateActivation = async (id, state) => {
    return await axios.get(`<?= $base_url ?>api/user-activation.api.php?user_id=${id}&state=${state}`).then(res => res.data);
  }

  const changeActivation = async (id, state) => {
    const result = await updateActivation(id, !state);

    if(result.status) {
      location.reload();
    }
  }
</script>