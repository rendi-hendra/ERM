<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>
<?= $this->include('layout/topbar') ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">
    <?= isset($pasien) ? 'Edit Pasien' : 'Tambah Pasien' ?>
  </h1>

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
          <h6 class="m-0 font-weight-bold text-white">
            <?= isset($pasien) ? 'Form Edit Pasien' : 'Form Tambah Pasien' ?>
          </h6>
        </div>

        <div class="card-body">
          <form method="post"
            action="<?= isset($pasien) ? base_url('pasien/update/' . $pasien['id']) : base_url('pasien/store') ?>">
            <?= csrf_field() ?>

            <div class="form-group mb-3">
              <label for="nik">NIK</label>
              <input type="text" id="nik" name="nik" class="form-control"
                value="<?= esc($pasien['nik'] ?? '') ?>" required>
            </div>

            <div class="form-group mb-3">
              <label for="nama">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" class="form-control"
                value="<?= esc($pasien['nama'] ?? '') ?>" required>
            </div>

            <div class="form-group mb-3">
              <label for="tanggal_lahir">Tanggal Lahir</label>
              <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                value="<?= esc($pasien['tanggal_lahir'] ?? '') ?>" required>
            </div>

            <div class="form-group mb-3">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?= (isset($pasien) && $pasien['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= (isset($pasien) && $pasien['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
              </select>
            </div>

            <div class="form-group mb-3">
              <label for="alamat">Alamat</label>
              <textarea id="alamat" name="alamat" class="form-control" rows="3"><?= esc($pasien['alamat'] ?? '') ?></textarea>
            </div>

            <div class="form-group mb-4">
              <label for="no_hp">No. HP</label>
              <input type="text" id="no_hp" name="no_hp" class="form-control"
                value="<?= esc($pasien['no_hp'] ?? '') ?>">
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= base_url('pasien') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>