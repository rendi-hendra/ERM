<h1 class="text-2xl font-bold mb-2 mt-12">Asuransi Pasien</h1>
<div class="flex justify-between items-center mb-4">
    <form method="get" action="<?= base_url('asuransi-pasien') ?>" class="inline-flex w-1/2">
        <input type="text" name="keyword" id="keyword" placeholder="Cari berdasarkan nik nama atau no.kartu"
            value="<?= esc($keyword ?? '') ?>"
            class="w-1/2 border border-gray-300 rounded-l-xl px-4 py-2">
        <button type="submit"
            class="bg-gray-900 text-white px-5 py-2 rounded-r-xl hover:bg-gray-700"><i class="bi bi-search"></i></button>
    </form>

    <a href="<?= base_url('/asuransi-pasien/create') ?>" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        <i class="bi bi-file-earmark-plus mr-1"></i></i> Tambah Asuransi Pasien
    </a>
</div>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">No. Kartu</th>
                <th class="px-4 py-3 text-left font-semibold">Nama Asuransi</th>
                <th class="px-4 py-3 text-left font-semibold">Hak Kelas</th>
                <th class="px-4 py-3 text-left font-semibold">Status</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (empty($asuransiPasien)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                        Belum ada data asuransi pasien
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($asuransiPasien as $a): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($a['no_kartu']) ?></td>
                        <td class="px-4 py-3"><?= esc($a['nama_asuransi']) ?></td>
                        <td class="px-4 py-3"><?= esc($a['hak_kelas']) ?></td>
                        <td class="px-4 py-3"><?= esc($a['aktif'] ? 'Aktif' : 'Nonaktif') ?></td>
                        <td class="px-4 py-3 text-center">
                            <a href="<?= base_url('/asuransi-pasien/edit/' . $a['id']) ?>" class="text-blue-600 hover:bg-gray-200 p-2 rounded-lg btnEdit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>

                            <a href="#"
                                class="text-red-600 hover:bg-gray-200 p-2 rounded-lg ml-3 btn-delete"
                                data-url="<?= base_url('/asuransi-pasien/delete/' . $a['id']) ?>">
                                <i class="bi bi-trash text-lg"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-10">
    <?= $pager->links('asuransi_pasien', 'pagination') ?>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "<?= session()->getFlashdata('success') ?>",
                duration: 3000,
                close: false,
                gravity: "top",
                position: "right",
                style: {
                    background: "#36b526",
                }
            }).showToast();
        });
    </script>
<?php endif; ?>