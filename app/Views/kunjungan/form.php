<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6">
  <h1 class="max-w-3xl mx-auto text-2xl font-bold text-gray-800 mb-6">
    <?= isset($kunjungan) ? 'Edit Kunjungan Pasien' : 'Tambah Kunjungan Pasien' ?>
  </h1>

  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">
    <div class="border-b border-gray-200 pb-2">
      <h2 class="text-lg font-semibold text-gray-700">
        <?= isset($kunjungan) ? 'Form Edit Kunjungan Pasien' : 'Form Tambah Kunjungan Pasien' ?>
      </h2>
    </div>

    <form method="post" action="<?= isset($kunjungan) ? base_url('kunjungan/update/' . $kunjungan['id']) : base_url('kunjungan/create') ?>" class="space-y-5">
      <?= csrf_field() ?>
      <div>
        <label for="pasien" class="block text-sm font-medium text-gray-700 mb-1">Pasien <span class="text-red-500">*</span></label>
        <select name="pasien_id" id="pasien"
          class="w-full <?= isset($validation) && $validation->hasError('pasien_id') ? 'border-red-500' : 'border-gray-300' ?> focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Pasien --</option>
          <?php foreach ($pasien as $p): ?>
            <option value="<?= esc($p['id']) ?>" <?= esc($kunjungan['pasien_id'] ?? $oldInput['pasien_id'] ?? '') == esc($p['id']) ? 'selected' : '' ?>><?= esc($p['nama']) ?> - <?= esc($p['nik']) ?></option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($validation) && $validation->hasError('pasien_id')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('pasien_id') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan <span class="text-red-500">*</span></label>
        <input type="datetime-local" name="tanggal_kunjungan" id="tanggal_kunjungan"
          class="w-full border <?= isset($validation) && $validation->hasError('tanggal_kunjungan') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
          value="<?= esc($oldInput['tanggal_kunjungan'] ?? ($kunjungan['tanggal_kunjungan']) ?? '') ?>" require>
        <?php if (isset($validation) && $validation->hasError('tanggal_kunjungan')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('tanggal_kunjungan') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Unit <span class="text-red-500">*</span></label>
        <select name="unit_id" id="unit"
          class="w-full <?= isset($validation) && $validation->hasError('unit_id') ? 'border-red-500' : 'border-gray-300' ?> focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Unit --</option>
          <?php foreach ($unit as $u): ?>
            <option value="<?= esc($u['id']) ?>" <?= esc($kunjungan['unit_id'] ?? $oldInput['unit_id'] ?? '') == esc($u['id']) ? 'selected' : '' ?>><?= esc($u['nama']) ?></option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($validation) && $validation->hasError('unit_id')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('unit_id') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="empOnUnit" class="block text-sm font-medium text-gray-700 mb-1">Dokter <span class="text-red-500">*</span></label>
        <select name="emp_on_unit_id" id="empOnUnit" disabled
          class="w-full <?= isset($validation) && $validation->hasError('emp_on_unit_id') ? 'border-red-500' : 'border-gray-300' ?> focus:ring-2 focus:ring-blue-500">
        </select>
        <?php if (isset($validation) && $validation->hasError('emp_on_unit_id')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('emp_on_unit_id') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-1">Keluhan <span class="text-red-500">*</span></label>
        <input type="text" name="keluhan" id="keluhan"
          class="w-full border <?= isset($validation) && $validation->hasError('keluhan') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
          placeholder="Contoh: Demam"
          value="<?= esc($oldInput['keluhan'] ?? ($kunjungan['keluhan']) ?? '') ?>" require>
        <?php if (isset($validation) && $validation->hasError('keluhan')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('keluhan') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran <span class="text-red-500">*</span></label>
        <select name="metode_pembayaran" id="metode_pembayaran"
          class="w-full border <?= isset($validation) && $validation->hasError('metode_pembayaran') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Metode Pembayaran --</option>
          <option value="tunai" <?= esc($kunjungan['metode_pembayaran'] ?? $oldInput['metode_pembayaran'] ?? '') == 'tunai' ? 'selected' : '' ?>>Tunai</option>
          <option value="asuransi" <?= esc($kunjungan['metode_pembayaran'] ?? $oldInput['metode_pembayaran'] ?? '') == 'asuransi' ? 'selected' : '' ?>>Asuransi</option>
        </select>
        <?php if (isset($validation) && $validation->hasError('metode_pembayaran')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('metode_pembayaran') ?></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="asuransi_pasien_id" class="block text-sm font-medium text-gray-700 mb-1">Asuransi <span class="text-red-500">*</span></label>
        <select name="asuransi_pasien_id" id="asuransi_pasien_id"
          class="w-full <?= isset($validation) && $validation->hasError('asuransi_pasien_id') ? 'border-red-500' : 'border-gray-300' ?> focus:ring-2 focus:ring-blue-500">
        </select>
        <?php if (isset($validation) && $validation->hasError('asuransi_pasien_id')): ?>
          <p class="text-red-500 text-sm mt-1"><?= $validation->getError('asuransi_pasien_id') ?></p>
        <?php endif; ?>
      </div>

      <div class="flex justify-between pt-4">
        <a href="<?= base_url('kunjungan') ?>" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
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

<script>
  const OLD_UNIT_ID = <?= json_encode($oldInput['unit_id'] ?? null) ?>;
  const OLD_EMP_ID = <?= json_encode($oldInput['emp_on_unit_id'] ?? null) ?>;
  const EDIT_UNIT_ID = <?= json_encode($kunjungan['unit_id'] ?? null) ?>;
  const EDIT_EMP_ID = <?= json_encode($kunjungan['emp_on_unit_id'] ?? null) ?>;

  document.addEventListener('DOMContentLoaded', function() {

    const kunjungan = <?= isset($kunjungan) ? 'true' : 'false' ?>;
    const oldInputAsuransiPasienId = "<?= esc($oldInput['asuransi_pasien_id'] ?? '') ?>";

    const pasienSelect = new TomSelect("#pasien", {
      placeholder: "Pilih pasien...",
    });

    const asuransiSelect = new TomSelect("#asuransi_pasien_id", {
      placeholder: "Pilih asuransi...",
    });

    if (oldInputAsuransiPasienId) {
      const asuransiPasienId = document.querySelector('#asuransi_pasien_id');
      const pasienId = document.querySelector(`#pasien`);

      const url = `<?= base_url('pasien/asuransi/getByPasien/') ?>${pasienId.value}`;
      fetch(url)
        .then(res => res.json())
        .then(data => {
          data.forEach(item => {
            asuransiSelect.addOption({
              value: item.id,
              text: item.nama_asuransi
            });
          });
          asuransiSelect.setValue(data[0].id ?? '');
          asuransiSelect.refreshOptions(false);
        });
    }


    if (kunjungan) {
      const asuransiPasienId = document.querySelector('#asuransi_pasien_id');
      const pasienId = document.querySelector(`#pasien`);
      const asuransiId = <?= $kunjungan['asuransi_pasien_id'] ?? 0 ?>;


      const url = `<?= base_url('pasien/asuransi/getByPasien/') ?>${pasienId.value}`;
      fetch(url)
        .then(res => res.json())
        .then(data => {
          data.forEach(item => {
            asuransiSelect.addOption({
              value: item.id,
              text: item.nama_asuransi
            });
          });
          asuransiSelect.setValue(asuransiId ?? '');
          asuransiSelect.refreshOptions(false);
        });
    }

    document.querySelector("#pasien").addEventListener("change", function() {
      const pasienId = this.value;
      const url = `<?= base_url('pasien/asuransi/getByPasien/') ?>${pasienId}`;

      asuransiSelect.clear();
      asuransiSelect.clearOptions();

      if (pasienId) {
        fetch(url)
          .then(res => res.json())
          .then(data => {
            data.forEach(item => {
              asuransiSelect.addOption({
                value: item.id,
                text: item.nama_asuransi
              });
            });
            asuransiSelect.setValue(data.length ? data[0].id : '');
            asuransiSelect.refreshOptions(false);
          });
      }
    });

    const unitSelect = new TomSelect("#unit", {
      placeholder: "Pilih unit...",
    });

    const empOnUnitSelect = new TomSelect("#empOnUnit", {
      placeholder: "Pilih dokter...",
    });

    function loadDokterByUnit(unitId, selectedEmpId = null) {
      empOnUnitSelect.clear();
      empOnUnitSelect.clearOptions();
      empOnUnitSelect.disable();

      if (!unitId) return;

      fetch(`<?= base_url('kunjungan/unit/') ?>${unitId}/dokter`)
        .then(res => res.json())
        .then(data => {
          if (data.length === 0) {
            empOnUnitSelect.addOption({
              value: '',
              text: 'Dokter di unit ini belum tersedia'
            });
            empOnUnitSelect.setValue('');
            empOnUnitSelect.refreshOptions(false);
            empOnUnitSelect.disable();
            return;
          }

          data.forEach(item => {
            empOnUnitSelect.addOption({
              value: item.emp_id,
              text: item.nama
            });
          });

          empOnUnitSelect.enable();

          if (selectedEmpId) {
            empOnUnitSelect.setValue(selectedEmpId);
          } else if (data.length === 1) {
            empOnUnitSelect.setValue(data[0].emp_id);
          }

          empOnUnitSelect.refreshOptions(false);
        })
        .catch(() => {
          empOnUnitSelect.disable();
        });
    }

    unitSelect.on('change', function(unitId) {
      loadDokterByUnit(unitId);
    });

    // Jika edit, load dokter berdasarkan unit yang sudah dipilih
    if (OLD_UNIT_ID) {
      unitSelect.setValue(OLD_UNIT_ID);
      loadDokterByUnit(OLD_UNIT_ID, OLD_EMP_ID);
    } else {
      unitSelect.setValue(EDIT_UNIT_ID);
      loadDokterByUnit(EDIT_UNIT_ID, EDIT_EMP_ID);
    }

  });
</script>

<?= $this->endSection() ?>