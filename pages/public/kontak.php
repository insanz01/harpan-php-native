<?php
  include "config/config.php";
?>

<style>
    #captcha-box {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      font-weight: bold;
      height: 100px;
      border: 2px solid #ccc;
      margin: 20px;
    }
  </style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kontak Kami</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Kontak</a></li>
          <li class="breadcrumb-item active">Kontak Kami</li>
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
      <div class="col-7 mx-auto">
        <div class="card">
          <div class="card-body">
            <!-- <img src="https://ngepop.id/upload/media/entries/2023-05/31/361-entry-0-1685513035.jpg" class="text-center w-100" alt=""> -->
            <img src="./dist/img/logo_banjarmasin.jpg" class="text-center w-100" alt="">
            <!-- <p class="py-3">Dinas Ketahanan Pangan, Pertanian, dan Perikanan (DKP3) Kota Banjarmasin adalah sebuah lembaga pemerintah yang bertanggung jawab atas pengelolaan sektor pertanian, perikanan, dan ketahanan pangan di Kota Banjarmasin, Indonesia.</p> -->

            <button class="btn btn-primary btn-block" role="button"  data-toggle="modal" data-target="#kritikSaranModal">KRITIK DAN SARAN</button>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>

<!-- Modal -->
<div class="modal fade" id="kritikSaranModal" tabindex="-1" aria-labelledby="kritikSaranModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kritikSaranModalLabel">Kritik dan Saran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Alamat</label>
          <input type="text" name="alamat" id="alamat" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="">No HP</label>
          <input type="text" name="no_hp" id="no_hp" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Masukan kritik dan saran anda pada kolom ini</label>
          <textarea name="kritik_saran" id="kritik_saran" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
          <img src="./generate.php" alt="captcha">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="captcha" id="captcha" maxlength="5" placeholder="kode captcha">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" onclick="kirimKritikSaran()" class="btn btn-primary">Kirim</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Generate random CAPTCHA text
  function generateCaptchaText(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let captchaText = '';
    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      captchaText += characters[randomIndex];
    }
    return captchaText;
  }

  // Render CAPTCHA
  function renderCaptcha() {
    const captchaBox = document.getElementById('captcha-box');
    const captchaText = generateCaptchaText(6);
    captchaBox.textContent = captchaText;
  }

  // Initialize CAPTCHA on page load
  window.onload = renderCaptcha;

  // Refresh CAPTCHA when clicked
  document.getElementById('captcha-box').addEventListener('click', renderCaptcha);
</script>
<script>
  const loadData = async () => {
    return await axios.get(`<?= $base_url ?>/api/publik-stok.api.php`).then(res => res.data);
  }

  const saveKritikSaran = async (data) => {
    return await axios.post(`<?= $base_url ?>/api/add-kritik-saran.api.php`, data, {
      headers: {
        "Content-Type": "multipart/form-data"
      }
    }).then(res => res.data);
  }

  const kirimKritikSaran = async () => {
    const kritikSaran = document.getElementById('kritik_saran').value;
    const nama = document.getElementById('nama').value;
    const alamat = document.getElementById('alamat').value;
    const no_hp = document.getElementById('no_hp').value;
    const email = document.getElementById('email').value;
    const captcha = document.getElementById('captcha').value;

    const captchaSession = `<?= $_SESSION["code"] ?>`;

    if(captchaSession != captcha) {
      alert("captcha yang anda masukan salah!");
      return;
    }

    const data = {
      "kritik_saran": kritikSaran,
      nama, alamat, no_hp, email, captcha
    }

    const result = await saveKritikSaran(data);

    if(result.status == true) {
      window.location.href = "<?= $base_url ?>index.php?page=kontak-kami"
    }
  }

  const renderTable = (data) => {
    const target = document.getElementById('tabel-stok');

    let temp = ``;

    let role_id = `<?= $role_id ?>`;

    data.forEach((res, index) => {
      temp += `
              <tr>
                <td>${index + 1}</td>
                <td>${res.nama}</td>
                <td>${res.satuan}</td>
                <td>${res.stok}</td>
                <td>${res.created_at}</td>
              </tr>
            `;
    });

    target.innerHTML = temp;
  }

  const showData = async () => {
    const result = await loadData();

    console.log("log stok", result);

    if(result.status) {
      renderTable(result.data);
    }
  }

  window.addEventListener("load", async () => {
    await showData();
  })
</script>