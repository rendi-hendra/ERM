<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/tabs') ?>
<div class="">
    <h1 class="mx-auto text-2xl font-bold text-gray-800 mb-6">
        <?= isset($soap) ? 'Edit SOAP' : 'Tambah SOAP' ?>
    </h1>
    <div class="mx-auto">
        <form method="post" action="<?= isset($soap) ? base_url('kunjungan/' . $kunjunganId . '/soap/update/' . $soap['id']) : base_url('kunjungan/' . $kunjunganId . '/soap/create') ?>" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label for="subjective" class="block text-sm font-medium text-gray-700 mb-1">
                    Subjective <span class="text-red-500">*</span>
                </label>
                <textarea name="subjective" id="subjective"
                    class="w-full border <?= isset($validation) && $validation->hasError('subjective') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Subjective"><?= esc($oldInput['subjective'] ?? ($soap['subjective'] ?? '')) ?></textarea>
                <?php if (isset($validation) && $validation->hasError('subjective')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('subjective') ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="objective" class="block text-sm font-medium text-gray-700 mb-1">Objective <span class="text-red-500">*</span></label>
                <textarea name="objective" id="objective"
                    class="w-full border <?= isset($validation) && $validation->hasError('objective') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 disabled:text-gray-500"
                    placeholder="Objective" disabled><?= esc($oldInput['objective'] ?? ($soap['objective'] ?? 'Belum melakukan pemeriksaan')) ?></textarea>
                <?php if (isset($validation) && $validation->hasError('objective')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('objective') ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="assessment" class="block text-sm font-medium text-gray-700 mb-1">Assessment <span class="text-red-500">*</span></label>
                <textarea name="assessment" id="assessment"
                    class="w-full border <?= isset($validation) && $validation->hasError('assessment') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Assessment"><?= esc($oldInput['assessment'] ?? ($soap['assesment'] ?? '')) ?></textarea>
                <?php if (isset($validation) && $validation->hasError('assessment')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('assessment') ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="plan" class="block text-sm font-medium text-gray-700 mb-1">Plan <span class="text-red-500">*</span></label>
                <textarea name="plan" id="plan"
                    class="w-full border <?= isset($validation) && $validation->hasError('plan') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 disabled:text-gray-500"
                    placeholder="Plan" disabled><?= esc($oldInput['plan'] ?? ($soap['plan'] ?? 'Belum menambahkan resep')) ?></textarea>
                <?php if (isset($validation) && $validation->hasError('plan')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('plan') ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status"
                    class="w-full border <?= isset($validation) && $validation->hasError('status') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="0" <?= esc($oldInput['status'] ?? '') == '0' ? 'selected' : '' ?>>Draf</option>
                    <option value="1" <?= esc($oldInput['status'] ?? '') == '1' ? 'selected' : '' ?>>Final</option>
                </select>
                <?php if (isset($validation) && $validation->hasError('status')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('status') ?></p>
                <?php endif; ?>
            </div>
            <div class="pt-3">
                <a href="<?= base_url('kunjungan/' . $kunjunganId . '/soap') ?>" class="mr-3 px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
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