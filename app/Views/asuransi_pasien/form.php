<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6">
  <h1 class="max-w-3xl mx-auto text-2xl font-bold text-gray-800 mb-6">
    <?= isset($asuransiPasien) ? 'Edit Asuransi Pasien' : 'Tambah Asuransi Pasien' ?>
  </h1>

  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">
    <div class="border-b border-gray-200 pb-2">
      <h2 class="text-lg font-semibold text-gray-700">
        <?= isset($asuransiPasien) ? 'Form Edit Asuransi Pasien' : 'Form Tambah Asuransi Pasien' ?>
      </h2>
    </div>

    <form method="post" action="<?= isset($asuransiPasien) ? base_url('asuransi-pasien/update/' . $asuransiPasien['id']) : base_url('asuransi-pasien/create') ?>" class="space-y-5">
      <?= csrf_field() ?>
      <div>
        <label for="pasien" class="block text-sm font-medium text-gray-700 mb-1">Pasien *</label>
        <select name="pasien_id" id="pasien"
          class="w-full border <?= isset($validation) && $validation->hasError('pasien_id') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Pasien --</option>
          <?php foreach ($pasien as $p): ?>
            <option value="<?= esc($p['id']) ?>" <?= esc($asuransiPasien['pasien_id'] ?? '') == esc($p['id']) ? 'selected' : '' ?>><?= esc($p['nama']) ?> - <?= esc($p['nik']) ?></option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($validation) && $validation->hasError('pasien_id')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('pasien_id') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="asuransi" class="block text-sm font-medium text-gray-700 mb-1">Asuransi *</label>
        <select name="asuransi_id" id="asuransi"
          class="w-full border <?= isset($validation) && $validation->hasError('asuransi_id') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Asuransi --</option>
          <?php foreach ($asuransi as $a): ?>
            <option value="<?= esc($a['id']) ?>" <?= esc($asuransiPasien['asuransi_id'] ?? '') == esc($a['id']) ? 'selected' : '' ?>><?= esc($a['nama_asuransi']) ?></option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($validation) && $validation->hasError('asuransi_id')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('asuransi_id') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="no_kartu" class="block text-sm font-medium text-gray-700 mb-1">No. kartu Asuransi *</label>
        <input type="text" name="no_kartu" id="no_kartu"
          class="w-full border <?= isset($validation) && $validation->hasError('no_kartu') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
          placeholder="Contoh: 0001234567890"
          value="<?= esc($oldInput['no_kartu'] ?? ($asuransiPasien['no_kartu']) ?? '') ?>" require>
        <?php if (isset($validation) && $validation->hasError('no_kartu')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('no_kartu') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
        <select name="aktif" id="sttaus"
          class="w-full border <?= isset($validation) && $validation->hasError('asuransi_id') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Status --</option>
          <option value="0" <?= esc($asuransiPasien['aktif'] ?? '') == '0' ? 'selected' : '' ?>>Nonaktif</option>
          <option value="1" <?= esc($asuransiPasien['aktif'] ?? '') == '1' ? 'selected' : '' ?>>Aktif</option>
        </select>
        <?php if (isset($validation) && $validation->hasError('aktif')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('aktif') ?></p>
        <?php endif; ?>
      </div>



      <div class="flex justify-between pt-4">
        <a href="<?= base_url('asuransi-pasien') ?>" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
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