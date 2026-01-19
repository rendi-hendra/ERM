<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h1 class="max-w-3xl mx-auto text-2xl font-bold text-gray-800 mb-6">
        <?= isset($employee) ? 'Edit Karyawan' : 'Tambah Karyawan' ?>
    </h1>

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">
        <div class="border-b border-gray-200 pb-2">
            <h2 class="text-lg font-semibold text-gray-700">
                <?= isset($employee) ? 'Form Edit Karyawan' : 'Form Tambah Karyawan' ?>
            </h2>
        </div>

        <form method="post" action="<?= isset($employee) ? base_url('employees/update/' . $employee['id']) : base_url('employees/create') ?>" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label for="sip" class="block text-sm font-medium text-gray-700 mb-1">SIP<span class="text-red-500">*</span></label>
                <input type="text" name="sip" id="sip"
                    placeholder="contoh: 1234567890"
                    class="w-full border <?= isset($validation) && $validation->hasError('sip') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="<?= esc($oldInput['sip'] ??  ($employee['sip']) ?? '') ?>" require>
                <?php if (isset($validation) && $validation->hasError('sip')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('sip') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama<span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama"
                    placeholder="contoh: Dr. John Doe"
                    class="w-full border <?= isset($validation) && $validation->hasError('nama') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="<?= esc($oldInput['nama'] ??  ($employee['nama']) ?? '') ?>" require>
                <?php if (isset($validation) && $validation->hasError('nama')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('nama') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis<span class="text-red-500">*</span></label>
                <!-- <input type="text" name="jenis" id="jenis"
                    placeholder="contoh: Dokter"
                    class="w-full border <?= isset($validation) && $validation->hasError('jenis') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    value="<?= esc($oldInput['jenis'] ?? ($employee['jenis']) ?? '') ?>" require> -->

                <select name="jenis" id="jenis"
                    class="w-full border <?= isset($validation) && $validation->hasError('jenis') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    require>
                    <option value="" disabled <?= !isset($oldInput['jenis']) && !isset($employee['jenis']) ? 'selected' : '' ?>>-- Pilih Jenis --</option>
                    <option value="Dokter" <?= (isset($oldInput['jenis']) && $oldInput['jenis'] === 'dokter') || (isset($employee['jenis']) && $employee['jenis'] === 'dokter') ? 'selected' : '' ?>>Dokter</option>
                    <option value="Admin" <?= (isset($oldInput['jenis']) && $oldInput['jenis'] === 'admin') || (isset($employee['jenis']) && $employee['jenis'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                    <option value="Perawat" <?= (isset($oldInput['jenis']) && $oldInput['jenis'] === 'perawat') || (isset($employee['jenis']) && $employee['jenis'] === 'perawat') ? 'selected' : '' ?>>Perawat</option>
                    <option value="Apoteker" <?= (isset($oldInput['jenis']) && $oldInput['jenis'] === 'apoteker') || (isset($employee['jenis']) && $employee['jenis'] === 'apoteker') ? 'selected' : '' ?>>Apoteker</option>
                    <option value="Bidan" <?= (isset($oldInput['jenis']) && $oldInput['jenis'] === 'bidan') || (isset($employee['jenis']) && $employee['jenis'] === 'bidan') ? 'selected' : '' ?>>Bidan</option>
                    <option value="Teknisi Medis" <?= (isset($oldInput['jenis']) && $oldInput['jenis'] === 'teknisi medis') || (isset($employee['jenis']) && $employee['jenis'] === 'teknisi medis') ? 'selected' : '' ?>>Teknisi Medis</option>
                </select>
                <?php if (isset($validation) && $validation->hasError('jenis')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('jenis') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. HP <span class="text-red-500">*</span></label>
                <input type="text" name="no_hp" id="no_hp"
                    placeholder="contoh: 081234567890"
                    class="w-full border <?= isset($validation) && $validation->hasError('no_hp') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    value="<?= esc($oldInput['no_hp'] ?? ($employee['no_hp']) ?? '') ?>" require>
                <?php if (isset($validation) && $validation->hasError('no_hp')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('no_hp') ?></p>
                <?php endif; ?>
            </div>

            <div class="flex justify-between pt-4">
                <a href="<?= base_url('employees') ?>" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
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