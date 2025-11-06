<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6">
  <h1 class="max-w-3xl mx-auto text-2xl font-bold text-gray-800 mb-6">
    <?= isset($asuransi) ? 'Edit Asuransi' : 'Tambah Asuransi' ?>
  </h1>

  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">
    <div class="border-b border-gray-200 pb-2">
      <h2 class="text-lg font-semibold text-gray-700">
        <?= isset($asuransi) ? 'Form Edit Asuransi' : 'Form Tambah Asuransi' ?>
      </h2>
    </div>

    <form method="post" action="<?= isset($asuransi) ? base_url('asuransi/update/' . $asuransi['id']) : base_url('asuransi/create') ?>" class="space-y-5">
      <?= csrf_field() ?>
      <div>
        <label for="nama_asuransi" class="block text-sm font-medium text-gray-700 mb-1">Nama Asuransi</label>
        <input type="text" name="nama_asuransi" id="nama_asuransi"
          class="w-full border <?= isset($validation) && $validation->hasError('nama_asuransi') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          value="<?= esc($oldInput['nama_asuransi'] ??  ($asuransi['nama_asuransi']) ?? '') ?>" require>

        <?php if (isset($validation) && $validation->hasError('nama_asuransi')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('nama_asuransi') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="no_kontak" class="block text-sm font-medium text-gray-700 mb-1">No. Kontak</label>
        <input type="text" name="no_kontak" id="no_kontak"
          class="w-full border <?= isset($validation) && $validation->hasError('no_kontak') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
          value="<?= esc($oldInput['no_kontak'] ?? ($asuransi['no_kontak']) ?? '') ?>" require>
        <?php if (isset($validation) && $validation->hasError('no_kontak')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('no_kontak') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3"
          class="w-full border <?= isset($validation) && $validation->hasError('alamat') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" require><?= esc($oldInput['alamat'] ?? ($asuransi['alamat']) ?? '') ?></textarea>
        <?php if (isset($validation) && $validation->hasError('alamat')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('alamat') ?></p>
        <?php endif; ?>
      </div>

      <div class="flex justify-between pt-4">
        <a href="<?= base_url('asuransi') ?>" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
          ← Kembali
        </a>
        <button type="submit"
          class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>