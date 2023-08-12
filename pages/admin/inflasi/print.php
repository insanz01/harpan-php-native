<?php
  include "config/config.php";
  include "controller/admin-inflasi.controller.php";

  $role_id = 0;
  if(isset($_SESSION["SESS_HARPAN_ROLE_ID"])) {
    $role_id = $_SESSION["SESS_HARPAN_ROLE_ID"];
  }
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Inflasi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Data</a></li>
          <li class="breadcrumb-item active">Inflasi</li>
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
      <div class="col-8">
        <div class="form-group">
          <?php if($role_id != 3): ?>
            <a href="#" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#laporanModal" data-id="inflasi" onclick="printLaporan(this)">
              <i class="fas fa-fw fa-print"></i>
              Cetak
            </a>
          <?php endif; ?>
            <!-- <a href="#" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#cetakModal">
            <i class="fas fa-fw fa-print"></i>
            Cetak
          </a> -->
          <?php if($role_id == 2 || $role_id == 3): ?>
            <!-- <a href="?page=distributor&action=tambah" class="btn btn-success float-right mx-2" role="button">
              <i class="fas fa-fw fa-plus"></i>
              Tambah
            </a> -->
          <?php endif; ?>
          <?php if($role_id == 1): ?>
            <!-- <a href="#!" class="btn btn-success float-right mx-2" role="button" data-toggle="modal" data-target="#verifikasiModal" onclick="selectVerifikasiData(-1)">
              <i class="fas fa-fw fa-plus"></i>
              VERIFIKASI
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
                  <th>Nama Komoditi</th>
                  <th>Satuan</th>
                  <th>Harga Eceran Sekarang</th>
                  <th>Harga Eceran Sebelumnya</th>
                  <th>Nilai Inflasi</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $number = 1; ?>
                <?php foreach($data as $dt): ?>
                  <tr>
                  <td><?= $number++ ?></td>
                    <td><?= $datum['nama'] ?></td>
                    <td><?= $datum['satuan'] ?></td>
                    <td><?= $datum['harga_baru'] ?></td>
                    <td><?= $datum['harga_lama'] ?></td>
                    <td><?= $datum['nilai'] ?></td>
                    <td><?= $datum['created_at'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
     <br>
    <div class="row">
      <div class="col">
        <form method="post" class="form-inline">
           <input type="date" name="tgl_mulai" class="form-control">
           <input type="date" name="tgl_selesai" class="form-control ml-2">
           <button type="submit" name="filter-tanggal" class="btn btn-info ml-2">Filter</button>
        </form>
       </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Modal -->

<script>
  let DELETE_ID = 0;
  let VERIFIKASI_ID = 0;

  const loadData = async () => {
    return await axios.get(`<?= $base_url ?>/api/get-inflasi.api.php`).then(res => res.data);
  }

  const printReport = async () => {
    const periodeAwal = document.getElementById("cetak-tanggal-awal").value;
    const periodeAkhir = document.getElementById("cetak-tanggal-akhir").value;

    console.log(periodeAwal);
    console.log(periodeAkhir);
  }

  const selectDeleteData = (delete_id) => {
    DELETE_ID = delete_id;
  }

  const doDelete = async (data) => {
    return await axios.post(`<?= $base_url ?>/api/delete-distributor.api.php`, data, {
      headers: {
        "Content-Type": "multipart/form-data"
      }
    }).then(res => res.data);
  }

  const deleteData = async () => {
    
    const data = {
      id: DELETE_ID
    }

    const result = await doDelete(data);

    console.log("delete response :", result);

    if(result) {
      location.reload();
    }
  }

  const selectVerifikasiData = (verifikasi_id) => {
    VERIFIKASI_ID = verifikasi_id;
  }

  const doVerifikasi = async (data) => {
    return await axios.post(`<?= $base_url ?>/api/approve-distributor.api.php`, data, {
      headers: {
        "Content-Type": "multipart/form-data"
      }
    }).then(res => res.data);
  }

  const verifikasiData = async () => {
    
    const data = {
      id: VERIFIKASI_ID
    }

    const result = await doVerifikasi(data);

    console.log("verifikasi response :", result);

    if(result) {
      location.reload();
    }
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
                
            `;

      if(res.approved_at) {
        temp += `<td>Terverifikasi</td>`;
      } else {
        temp += `<td>Belum Diverifikasi</td>`
      }
      
      if(role_id == 1) {
        if(res.approved_at == null) {
          // temp += `
          //         <td>
          //           <a href="#" class="btn btn-primary float-right mx-2" role="button" data-toggle="modal" data-target="#verifikasiModal" onclick="selectVerifikasiData(${res.id})">
          //             <i class="fas fa-fw fa-book"></i>
          //             Verifikasi
          //           </a>
          //         </td>
          //       </tr>`;
        } else {
          temp += `
                  <td>
                    
                  </td>
                </tr>`;
        }
      } else {
        temp += `
                <td>
                  <a href="#" class="btn btn-danger float-right" role="button" data-toggle="modal" data-target="#hapusModal" onclick="selectDeleteData(${res.id})">
                    <i class="fas fa-fw fa-trash"></i>
                    Hapus
                  </a>
                  <a href="?page=distributor&action=edit&id=${res.id}" class="btn btn-primary float-right mx-2" role="button">
                    <i class="fas fa-fw fa-edit"></i>
                    Ubah
                  </a>
                </td>
              </tr>`;
      }
    });

    target.innerHTML = temp;
  }

  const showData = async () => {
    const result = await loadData();

    if(result.status) {
      renderTable(result.data);
    }
  }

  window.addEventListener("load", async () => {
    await showData();
  })

</script>