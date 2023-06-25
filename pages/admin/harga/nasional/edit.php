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
        <h1 class="m-0">Harga Nasional</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Harga</a></li>
          <li class="breadcrumb-item active">Edit Nasional</li>
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
            <input type="hidden" name="id" id="id_edit">

            <div class="form-group">
              <label for="">Nama Komoditi</label>
              <select name="id_komoditas" class="form-control" id="id_komoditas">
                <option value="">- PILIH -</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Harga</label>
              <input type="number" class="form-control" id="harga">
            </div>
            <div class="form-group">
              <label for="">Tanggal</label>
              <input type="date" class="form-control" value="<?= date('Y-m-d', time()) ?>" readonly id="tanggal">
            </div>
            <div class="form-group">
              <button class="btn btn-success btn-block" type="button" role="button" onclick="submitData()">Simpan Data Harga Nasional</button>
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
    return await axios.post(`<?= $base_url ?>api/edit-nasional.api.php`, data, {
      headers: {
        "Content-Type": "multipart/form-data"
      }
    }).then(res => res.data);
  }

  const loadKomoditas = async () => {
    return await axios.get(`<?= $base_url ?>api/komoditas.api.php?id=<?= $id_edit ?>`).then(res => res.data);
  }

  const submitData = async () => {
    const id = documentn.getElementById("id_edit").value;
    const harga = document.getElementById("harga").value;
    const id_komoditas = document.getElementById("id_komoditas").value;
    const tanggal = document.getElementById("tanggal").value;

    const data = {
      id,
      harga,
      id_komoditas,
      tanggal
    }

    console.log(data);

    const result = await saveData(data);

    if(result.status) {
      window.location.href = "<?= $base_url ?>index.php?page=nasional"
    }
  }

  const renderSelectOption = async (target, data) => {
    const listOpt = document.getElementById(target);

    let temp = `<option value="">- PILIH -</option>`

    data.forEach(res => {
      temp += `<option value="${res.id}">${res.nama}</option>`
    });

    listOpt.innerHTML = temp;
  }

  // const setOptionValue = (target, data) => {

  // }

  const setValue = (target, data) => {
    document.getElementById(target).value = data;
  }

  const getData = async () => {
    return await axios.get(`<?= $base_url ?>api/get-nasional.api.php`).then(res => res.data);
  }

  const showData = async () => {
    const result = await getData();

    if(result.status) {
      setValue("id_edit", result.data.id);
      setValue("id_komoditas", result.data.id_komoditas);
      setValue("harga", result.data.harga);
    }
  }

  window.addEventListener('load', async () => {
    const komoditiResult = await loadKomoditas();

    if(komoditiResult.status) {
      await renderSelectOption('id_komoditas', komoditiResult.data);
    }

    await showData();
  })
</script>