<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>
    <h1 class="mx-auto text-2xl font-bold text-gray-800 mb-6">
        <?= isset($unit) ? 'Edit Unit' : 'Tambah Unit' ?>
    </h1>

    <div class="mx-auto">
        <form method="post" action="<?= isset($unit) ? base_url('unit/update/' . $unit['id']) : base_url('unit/create') ?>" class="space-y-5">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Nama Unit -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Unit <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama"
                        placeholder="Contoh: Poli Umum"
                        class="w-full border <?= isset($validation) && $validation->hasError('nama') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        value="<?= esc($oldInput['nama'] ??  ($unit['nama']) ?? '') ?>" require>
                    <?php if (isset($validation) && $validation->hasError('nama')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('nama') ?></p>
                    <?php endif; ?>
                </div>

                <!-- Kategori Unit -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori Unit <span class="text-red-500">*</span></label>
                    <select name="kategori" id="kategori"
                        class="w-full border <?= isset($validation) && $validation->hasError('kategori') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="" disabled <?= !isset($oldInput['kategori']) && !isset($unit) ? 'selected' : '' ?>>-- Pilih Kategori --</option>
                        <option value="Rawat Jalan" <?= (isset($oldInput['kategori']) && $oldInput['kategori'] === 'Rawat Jalan') || (isset($unit) && $unit['kategori'] === 'Rawat Jalan') ? 'selected' : '' ?>>Rawat Jalan</option>
                        <option value="IGD" <?= (isset($oldInput['kategori']) && $oldInput['kategori'] === 'IGD') || (isset($unit) && $unit['kategori'] === 'IGD') ? 'selected' : '' ?>>IGD</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('kategori')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('kategori') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex space-x-3 mt-6">
                <a href="<?= base_url('unit') ?>"
                    class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300">
                    Batal
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <?= $this->endSection() ?>