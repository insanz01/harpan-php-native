<?php
  include "config/config.php";

  $role_id = 0;
  if(isset($_SESSION["SESS_HARPAN_ROLE_ID"])) {
    $role_id = $_SESSION["SESS_HARPAN_ROLE_ID"];
  }
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Harga</a></li>
          <li class="breadcrumb-item active">Grosir</li>
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
          <a href="#" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#cetakModal">
            <i class="fas fa-fw fa-print"></i>
            Cetak
          </a>
          <a href="?page=grosir&action=tambah" class="btn btn-success float-right mx-2" role="button">
            <i class="fas fa-fw fa-plus"></i>
            Tambah
          </a>
        </div>
      </div>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12 mx-auto">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Komoditi</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Tanggal</th>
              <th class="text-right">Opsi</th>
            </tr>
          </thead>
          <tbody id="tabel-harga">

          </tbody>
        </table>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<!-- Modal -->
<div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="cetakModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cetakModalLabel">Cetak Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Laporan Periode (Tanggal Awal)</label>
          <input type="date" class="form-control" name="cetak-tanggal-awal">
        </div>
        <div class="form-group">
          <label for="">Laporan Periode (Tanggal Akhir)</label>
          <input type="date" class="form-control" name="cetak-tanggal-akhir">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" onclick="printReport()" class="btn btn-primary">Cetak</button>
      </div>
    </div>
  </div>
</div>

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

<script>
  const loadData = async () => {
    return await axios.get(`<?= $base_url ?>/api/get-grosir.api.php`).then(res => res.data);
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
    return await axios.post(`<?= $base_url ?>/api/delete-grosir.api.php`, data, {
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

      if(role_id == 1) {
        if(res.approved_at == null) {
          temp += `
                  <td>
                    <a href="#" class="btn btn-primary float-right mx-2" role="button">
                      <i class="fas fa-fw fa-book"></i>
                      Verifikasi
                    </a>
                  </td>
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
                  <a href="?page=grosir&action=edit&id=${res.id}" class="btn btn-primary float-right mx-2" role="button">
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