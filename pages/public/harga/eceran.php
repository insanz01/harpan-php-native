<?php
  include "config/config.php";

  include "controller/publik-eceran-harga.controller.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Harga Eceran</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="row pt-4">
      <div class="col-4"></div>
      <div class="col-4"></div>
      <div class="col-4">
        <form id="filter-tanggal" action="?page=harga-eceran-publik" method="post">
          <div class="form-group">
            <label for="filter_tanggal">Filter Tanggal</label>
            <input type="date" name="filter_tanggal" class="form-control" onchange="pilihTanggal(this)" value="<?= $filter_tanggal ?>">
          </div>
        </form>
      </div>
    </div>

    <script>
      const pilihTanggal = () => {
        const myForm = document.getElementById("filter-tanggal");
        myForm.submit();
      }
    </script>

    <div class="row pt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h3>Harga Eceran</h3>
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Komoditas</th>
                  <?php foreach($week_dates as $k): ?>
                    <th><?= $k ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($week_datas as $data): ?>
                  <tr>
                    <td><?= $data[0] ?></td>
                    <td><?= number_format($data[1], 0, ',', '.') ?></td>
                    <td><?= number_format($data[2], 0, ',', '.') ?></td>
                    <td><?= number_format($data[3], 0, ',', '.') ?></td>
                    <td><?= number_format($data[4], 0, ',', '.') ?></td>
                    <td><?= number_format($data[5], 0, ',', '.') ?></td>
                    <td><?= number_format($data[6], 0, ',', '.') ?></td>
                    <td><?= number_format($data[7], 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Main row -->
    <!-- <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <canvas height="100px" id="hargaChart"></canvas>
          </div>
        </div>
      </div>
    </div> -->
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  const loadData = async () => {
    return await axios.get(`<?= $base_url ?>/api/publik-eceran.api.php`).then(res => res.data);
  }

  const renderTable = (data) => {
    const target = document.getElementById('tabel-harga');

    let temp = ``;

    let role_id = `<?= $role_id ?>`;

    data.forEach((res, index) => {
      temp += `
              <tr>
                <td>${index + 1}</td>
                <td>${res.nama}</td>
                <td>${res.satuan}</td>
                <td>${res.harga}</td>
                <td>${res.created_at}</td>
              </tr>
            `;
    });

    target.innerHTML = temp;
  }

  const showData = async () => {
    const result = await loadData();

    if(result.status) {
      renderTable(result.data);
    }
  }

  window.addEventListener('load', async () => {
    // const ctx = document.getElementById('hargaChart');

    // new Chart(ctx, {
    //   type: 'line',
    //   data: {
    //     labels: ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu', ''],
    //     datasets: [{
    //       label: '# Harga Eceran',
    //       data: [0, 12, 19, 3, 5, 2, 3, 10, 0],
    //       borderWidth: 1,
    //       borderColor: '#36A2EB',
    //       // backgroundColor: '#9BD0F5',
    //     }]
    //   },
    //   options: {
    //     scales: {
    //       y: {
    //         beginAtZero: true
    //       }
    //     }
    //   }
    // });

    await showData();
  })
</script>