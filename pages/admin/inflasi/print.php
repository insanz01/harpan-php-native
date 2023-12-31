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
        <!-- <div class="form-group">
          <label for="laporan-periode">Laporan Periode</label>
          <input type="date" class="form-control">
        </div> -->
      </div>
      <div class="col-8">
        <div class="form-group">
          <?php if($role_id != 3): ?>
            <a href="#" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#laporanModal" data-id="inflasi" onclick="printLaporan(this)">
              <i class="fas fa-fw fa-print"></i>
              Cetak
            </a>
          <?php endif; ?>
          <!-- <a href="#" class="btn btn-info float-right" role="button">
            <i class="fas fa-fw fa-print"></i>
            Cetak
          </a> -->
          <?php if($role_id == 2 || $role_id == 3): ?>
            <!-- <a href="?page=inflasi&action=tambah" class="btn btn-success float-right mx-2" role="button">
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
                <th>#</th>
                <th>Nama Komoditi</th>
                <th>Satuan</th>
                <th>Harga Eceran Sekarang</th>
                <th>Harga Eceran Sebelumnya</th>
                <th>Nilai Inflasi</th>
                <th>Tanggal</th>
                <?php if($role_id == 2 || $role_id == 3): ?>
                  <!-- <th>Opsi</th> -->
                <?php endif; ?>
              </thead>
              <tbody>
                <?php $number = 1; ?>
                <?php foreach($data as $datum): ?>
                  <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $datum['nama'] ?></td>
                    <td><?= $datum['satuan'] ?></td>
                    <td><?= $datum['harga_baru'] ?></td>
                    <td><?= $datum['harga_lama'] ?></td>
                    <td><?= $datum['nilai'] ?></td>
                    <td><?= $datum['created_at'] ?></td>
                    <?php if($role_id == 2 || $role_id == 3): ?>
                      <!-- <td>
                        <a href="#" class="btn btn-danger float-right" role="button" data-toggle="modal" data-target="#hapusModal" onclick="selectDeleteData(<?= $datum['id'] ?>)">
                          <i class="fas fa-fw fa-trash"></i>
                          Hapus
                        </a>
                        <a href="index.php?page=inflasi&action=edit&id=<?= $datum['id'] ?>" class="btn btn-primary float-right mx-2" role="button">
                          <i class="fas fa-fw fa-edit"></i>
                          Ubah
                        </a>
                      </td> -->
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusModalLabel">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" onclick="deleteData()" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin verifikasi data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" onclick="verifikasiData()" class="btn btn-primary">Verifikasi</button>
      </div>
    </div>
  </div>
</div>

<script>
  let DELETE_ID = 0;
  let VERIFIKASI_ID = 0;

  const loadData = async () => {
    return await axios.get(`<?= $base_url ?>/api/admin-inflasi.api.php`).then(res => res.data);
  }

  const selectDeleteData = (delete_id) => {
    DELETE_ID = delete_id;
  }

  const doDelete = async (data) => {
    return await axios.post(`<?= $base_url ?>/api/delete-inflasi.api.php`, data, {
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
    return await axios.post(`<?= $base_url ?>/api/approve-inflasi.api.php`, data, {
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
    const target = document.getElementById('tabel-inflasi');

    let temp = ``;

    let role_id = `<?= $role_id ?>`;

    data.forEach((res, index) => {
      temp += `
              <tr>
                <td>${index + 1}</td>
                <td>${res.nama}</td>
                <td>${res.satuan}</td>
                <td>${res.harga_baru}</td>
                <td>${res.harga_lama}</td>
                <td>${res.nominal}</td>
                <td>${res.created_at}</td>
                
            `;

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
          temp += `
                </tr>`;
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
                  <a href="index.php?page=inflasi&action=edit&id=${res.id}" class="btn btn-primary float-right mx-2" role="button">
                    <i class="fas fa-fw fa-edit"></i>
                    Ubah
                  </a>
                </td>
              </tr>`;
      }
    });

    console.log(temp);

    target.innerHTML = temp;
  }

  const showData = async () => {
    const result = await loadData();

    console.log(result.data);

    if(result.status) {
      renderTable(result.data);
    }
  }

  window.addEventListener("load", async () => {
    await showData();
  })

</script>