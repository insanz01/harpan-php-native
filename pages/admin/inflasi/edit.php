<?php
  include "config/config.php";

  $id_edit = 0;

  if(isset($_GET["id"])) {
    $id_edit = $_GET["id"];
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
          <li class="breadcrumb-item"><a href="#">Inflasi</a></li>
          <li class="breadcrumb-item active">Edit Inflasi</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="">Nama Komoditi</label>
              <select name="id_komoditas" class="form-control" id="id_komoditas">
                <option value="">- PILIH -</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Besaran Inflasi</label>
              <input type="number" class="form-control" id="nominal" placeholder="(nominal) %" onchange="setNilai(this)">
              <small>* Berikan nilai negatif jika inflasi turun.</small>
            </div>
            <div class="form-group">
              <label for="">Nilai</label>
              <input type="text" class="form-control" readonly id="nilai">
            </div>
            <div class="form-group">
              <label for="">Tanggal</label>
              <input type="date" class="form-control" value="<?= date('Y-m-d', time()) ?>" readonly id="tanggal">
            </div>
            <div class="form-group">
              <button class="btn btn-success btn-block" type="button" role="button" onclick="submitData()">Simpan Data Permintaan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
  const saveData = async (data) => {
    return await axios.post(`<?= $base_url ?>api/add-inflasi.api.php`, data, {
      headers: {
        "Content-Type": "multipart/form-data"
      }
    }).then(res => res.data);
  }

  const loadKomoditas = async () => {
    return await axios.get(`<?= $base_url ?>api/komoditas.api.php`).then(res => res.data);
  }

  const loadPermintaan = async () => {
    return await axios.get(`<?= $base_url ?>api/get-permintaan.api.php`).then(res => res.data);
  }

  const loadData = async () => {
    return await axios.get(`<?= $base_url ?>api/get-inflasi.api.php`).then(res => res.data);
  }

  const setNilai = (target) => {
    const nominal = target.value;
    const nilai = document.getElementById('nilai');
    let status = "Naik";

    if(nominal < 0) {
      status = "Turun";
    }

    if(Math.abs(nominal) < 10) {
      nilai.value = `${status} Rendah`;
    } else if (Math.abs(nominal) < 15) {
      nilai.value = `${status} Tinggi`;
    } else {
      nilai.value = `${status} Sangat Tinggi`;
    }
  }

  const submitData = async () => {
    const nominal = document.getElementById("nominal").value;
    const nilai = document.getElementById("nilai").value;
    const id_permintaan = document.getElementById("id_komoditas").value;
    const tanggal = document.getElementById("tanggal").value;

    const data = {
      nominal,
      nilai,
      id_permintaan,
      tanggal
    }

    console.log(data);

    const result = await saveData(data);

    console.log(result);

    if(result.status) {
      window.location.href = "<?= $base_url ?>index.php?page=inflasi"
    }
  }

  const renderSelectOption = async (target, data, inflasiData) => {
    const listOpt = document.getElementById(target);

    let temp = `<option value="">- PILIH -</option>`

    data.forEach(res => {
      console.log(inflasiData)
      if(inflasiData[0].id_komoditas == res.id) {
        temp += `<option value="${res.id}" selected>${res.nama}</option>`
      } else {
        temp += `<option value="${res.id}">${res.nama}</option>`
      }
    });

    listOpt.innerHTML = temp;
  }

  const setValue = (target, data) => {
    document.getElementById(target).value = data;
  }

  window.addEventListener('load', async () => {
    const komoditiResult = await loadPermintaan();

    const inflasiData = await loadData();

    console.log(komoditiResult);

    console.log("inflasi data", inflasiData);

    if(komoditiResult.status && inflasiData.status) {
      await renderSelectOption('id_komoditas', komoditiResult.data, inflasiData.data);

      setValue("nominal", inflasiData.data[0].nominal);
      setValue("nilai", inflasiData.data[0].nilai);
    }
  })
</script>