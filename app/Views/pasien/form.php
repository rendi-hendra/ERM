<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>
  <h1 class="mx-auto text-2xl font-bold text-gray-800 mb-6">
    <?= isset($pasien) ? 'Edit Pasien' : 'Tambah Pasien' ?>
  </h1>

  <div class="mx-auto">
    <form method="post" action="<?= isset($pasien) ? base_url('pasien/update/' . $pasien['id']) : base_url('pasien/create') ?>" class="space-y-5">
      <?= csrf_field() ?>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <!-- NIK -->
        <div>
          <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
          <input type="text" name="nik" id="nik"
            placeholder="Contoh: 3201012000010001"
            class="w-full border <?= isset($validation) && $validation->hasError('nik') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            value="<?= esc($oldInput['nik'] ??  ($pasien['nik']) ?? '') ?>" require>
          <?php if (isset($validation) && $validation->hasError('nik')): ?>
            <p class="text-red-500 text-sm mt-1"><?= $validation->getError('nik') ?></p>
          <?php endif; ?>
        </div>

        <!-- Nama -->
        <div>
          <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
          <input type="text" name="nama" id="nama"
            placeholder="Contoh: Budi Santoso"
            class="w-full border <?= isset($validation) && $validation->hasError('nama') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            value="<?= esc($oldInput['nama'] ?? ($pasien['nama']) ?? '') ?>" require>
          <?php if (isset($validation) && $validation->hasError('nama')): ?>
            <p class="text-red-500 text-sm mt-1"><?= $validation->getError('nama') ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Tanggal Lahir & Jenis Kelamin -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
          <input type="date" name="tanggal_lahir" id="tanggal_lahir"
            class="w-full border <?= isset($validation) && $validation->hasError('tanggal_lahir') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            value="<?= esc($oldInput['tanggal_lahir'] ?? ($pasien['tanggal_lahir']) ?? '') ?>" require>
          <?php if (isset($validation) && $validation->hasError('tanggal_lahir')): ?>
            <p class="text-red-500 text-sm mt-1"><?= $validation->getError('tanggal_lahir') ?></p>
          <?php endif; ?>
        </div>

        <div>
          <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
          <select name="jenis_kelamin" id="jenis_kelamin"
            class="w-full border <?= isset($validation) && $validation->hasError('jenis_kelamin') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="L" <?= esc($oldInput['jenis_kelamin'] ?? ($pasien['jenis_kelamin']) ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= esc($oldInput['jenis_kelamin'] ?? ($pasien['jenis_kelamin']) ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
          </select>
          <?php if (isset($validation) && $validation->hasError('jenis_kelamin')): ?>
            <p class="text-red-500 text-sm mt-1"><?= $validation->getError('jenis_kelamin') ?></p>
          <?php endif; ?>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <!-- Alamat -->
        <div>
          <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
          <textarea name="alamat" id="alamat" rows="3"
            placeholder="contoh: Jl. Merdeka No.123, Jakarta"
            class="w-full border <?= isset($validation) && $validation->hasError('alamat') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" require><?= esc($oldInput['alamat'] ?? ($pasien['alamat']) ?? '') ?></textarea>
          <?php if (isset($validation) && $validation->hasError('alamat')): ?>
            <p class="text-red-500 text-sm mt-1"><?= $validation->getError('alamat') ?></p>
          <?php endif; ?>
        </div>

        <!-- No HP -->
        <div>
          <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. HP <span class="text-red-500">*</span></label>
          <input type="text" name="no_hp" id="no_hp"
            placeholder="Contoh: 081234567890"
            class="w-full border <?= isset($validation) && $validation->hasError('no_hp') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            value="<?= esc($oldInput['no_hp'] ?? ($pasien['no_hp']) ?? '') ?>" require>
          <?php if (isset($validation) && $validation->hasError('no_hp')): ?>
            <p class="text-red-500 text-sm mt-1"><?= $validation->getError('no_hp') ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Tombol -->
      <div class="pt-3">
        <a href="<?= base_url('pasien') ?>" class="mr-3 px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
          Kembali
        </a>
        <button type="submit"
          class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Asuransi Pasien -->
<?php if (isset($pasien)): ?>
  <?= view('asuransi_pasien/index.php') ?>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '<?= session()->getFlashdata('success') ?>',
      timer: 2000,
      showConfirmButton: false
    });
  </script>
<?php endif; ?>

<script>
  document.querySelector('form').addEventListener('submit', function() {
    setTimeout(() => {
      document.getElementById('keyword').value = '';
    }, 100);
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        const url = this.getAttribute('data-url');

        Swal.fire({
          title: 'Yakin hapus data ini?',
          text: "Data yang dihapus tidak bisa dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
      });
    });
  });
</script>

<?= $this->endSection() ?>