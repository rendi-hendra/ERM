<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/tabs') ?>
<div class="">
    <h1 class="mx-auto text-2xl font-bold text-gray-800 mb-6">
        <?= isset($pemeriksaan) ? 'Edit SOAP' : 'Tambah SOAP' ?>
    </h1>
    <div class="mx-auto">
        <form method="post" action="<?= isset($pemeriksaan) ? base_url('kunjungan/' . $kunjunganId . '/pemeriksaan/update/' . $pemeriksaan['id']) : base_url('kunjungan/' . $kunjunganId . '/pemeriksaan/create') ?>" class="space-y-5">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                <div>
                    <label for="suhu" class="block text-sm font-medium text-gray-700 mb-1">
                        Suhu <span class="text-red-500">*</span>
                    </label>
                    <div class="flex">
                        <input name="suhu" id="suhu" type="number"
                            class="w-full border <?= isset($validation) && $validation->hasError('suhu') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="Suhu" value="<?= esc($oldInput['suhu'] ?? ($pemeriksaan['suhu'] ?? '')) ?>">
                        <div class="ml-1 mt-4">°C</div>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('suhu')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('suhu') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="td_sistolik" class="block text-sm font-medium text-gray-700 mb-1">
                        Tekanan Darah Sistolik <span class="text-red-500">*</span>
                    </label>
                    <input name="td_sistolik" id="td_sistolik" type="number"
                        class="w-full border <?= isset($validation) && $validation->hasError('td_sistolik') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="TD Sistolik" value="<?= esc($oldInput['td_sistolik'] ?? ($pemeriksaan['td_sistolik'] ?? '')) ?>">
                    <?php if (isset($validation) && $validation->hasError('td_sistolik')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('td_sistolik') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="td_diastolik" class="block text-sm font-medium text-gray-700 mb-1">
                        Tekanan Darah Diastolik <span class="text-red-500">*</span>
                    </label>
                    <input name="td_diastolik" id="td_diastolik" type="number"
                        class="w-full border <?= isset($validation) && $validation->hasError('td_diastolik') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="TD Diastolik" value="<?= esc($oldInput['td_diastolik'] ?? ($pemeriksaan['td_diastolik'] ?? '')) ?>">
                    <?php if (isset($validation) && $validation->hasError('td_diastolik')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('td_diastolik') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="nadi" class="block text-sm font-medium text-gray-700 mb-1">
                        Nadi <span class="text-red-500">*</span>
                    </label>
                    <div class="flex">
                        <input name="nadi" id="nadi" type="number"
                            class="w-full border <?= isset($validation) && $validation->hasError('nadi') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="Nadi" value="<?= esc($oldInput['nadi'] ?? ($pemeriksaan['nadi'] ?? '')) ?>">
                        <div class="ml-1 mt-4">/menit</div>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('nadi')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('nadi') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
                <div>
                    <label for="rr" class="block text-sm font-medium text-gray-700 mb-1">
                        Respiratory Rate <span class="text-red-500">*</span>
                    </label>
                    <div class="flex">
                        <input name="rr" id="rr" type="number"
                            class="w-full border <?= isset($validation) && $validation->hasError('rr') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="RR" value="<?= esc($oldInput['rr'] ?? ($pemeriksaan['rr'] ?? '')) ?>">
                        <div class="ml-1 mt-4">/menit</div>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('rr')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('rr') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="berat_badan" class="block text-sm font-medium text-gray-700 mb-1">
                        Berat Badan
                    </label>
                    <div class="flex">
                        <input name="berat_badan" id="berat_badan" type="number"
                            class="w-full border <?= isset($validation) && $validation->hasError('berat_badan') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="Berat Badan" value="<?= esc($oldInput['berat_badan'] ?? ($pemeriksaan['berat_badan'] ?? '')) ?>">
                        <div class="ml-1 mt-4">kg</div>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('berat_badan')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('berat_badan') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="tinggi_badan" class="block text-sm font-medium text-gray-700 mb-1">
                        Tinggi Badan
                    </label>
                    <div class="flex">
                        <input name="tinggi_badan" id="tinggi_badan" type="number"
                            class="w-full border <?= isset($validation) && $validation->hasError('tinggi_badan') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="Tinggi Badan" value="<?= esc($oldInput['tinggi_badan'] ?? ($pemeriksaan['tinggi_badan'] ?? '')) ?>">
                        <div class="ml-1 mt-4">cm</div>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('tinggi_badan')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $validation->getError('tinggi_badan') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                <textarea name="catatan" id="catatan"
                    class="w-full border <?= isset($validation) && $validation->hasError('catatan') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 disabled:text-gray-500"
                    placeholder="catatan"><?= esc($oldInput['catatan'] ?? ($pemeriksaan['catatan'] ?? '')) ?></textarea>
                <?php if (isset($validation) && $validation->hasError('catatan')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('catatan') ?></p>
                <?php endif; ?>
            </div>
            <div class="pt-3">
                <a href="<?= base_url('kunjungan/' . $kunjunganId . '/pemeriksaan') ?>" class="mr-3 px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
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
<?= $this->endSection() ?>