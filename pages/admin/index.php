<?php
  include "config/config.php";
  include "controller/dashboard.controller.php";
  
  $role_user = "";
  if(isset($_SESSION["SESS_HARPAN_ROLE"])) {
    $role_user = $_SESSION["SESS_HARPAN_ROLE"];
  }
?>

<style>
  .bg-ungu-unyu {
    background-color: #b19cd9;
    color: white;
  }
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="jumbrotron">
        <h3 class="display-3">Selamat Datang di Dashboard <?= $role_user ?></h3>
        <!-- <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni culpa sequi, delectus porro recusandae accusamus. Qui unde eum non consequuntur corrupti, velit suscipit neque voluptas, excepturi dolor molestiae, mollitia quia!</p> -->
      </div>
    </div>
  </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $totalKomoditas ?></h3>

            <p>Data Komoditas</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $totalStok ?><sup style="font-size: 20px"></sup></h3>

            <p>Data Ketersediaan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $totalPermintaan ?></h3>

            <p>Data Permintaan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $totalInflasi ?></h3>

            <p>Data Inflasi</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <?php if($role_id == 2 || $role_id == 1): ?>
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <div class="small-box bg-ungu-unyu">
            <div class="inner">
              <h3><?= $totalUnverified ?></h3>

              <p>Belum Verifikasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif; ?>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <div class="col-12">
        <canvas height="100px" id="tableChart"></canvas>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  window.addEventListener('load', () => {
    const ctx = document.getElementById('tableChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu', ''],
        datasets: [{
          label: '# Harga Pangan',
          data: [0, 12, 19, 3, 5, 2, 3, 10, 0],
          borderWidth: 1,
          borderColor: '#36A2EB',
          backgroundColor: '#9BD0F5',
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  })
</script>