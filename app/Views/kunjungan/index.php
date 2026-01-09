<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-2">Pendaftaran Kunjungan</h1>
<p class="text-gray-500 mb-6">Daftarkan kunjungan pasien ke rumah sakit</p>

<div class="flex justify-between items-center mb-4">
    <form method="get" action="<?= base_url('kunjungan') ?>" class="inline-flex w-1/2">
        <input type="text" name="keyword" id="keyword" placeholder="Cari berdasarkan tanggal nama atau nama dokter"
            value="<?= esc($keyword ?? '') ?>"
            class="w-1/2 border border-gray-300 rounded-l-xl px-4 py-2">
        <button type="submit"
            class="bg-gray-900 text-white px-5 py-2 rounded-r-xl hover:bg-gray-700"><i class="bi bi-search"></i></button>
    </form>

    <a href="<?= base_url('/kunjungan/create') ?>" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        <i class="bi bi-file-earmark-plus mr-1"></i></i> Tambah Kunjungan Pasien
    </a>
</div>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">Nama Pasien</th>
                <th class="px-4 py-3 text-left font-semibold">Unit</th>
                <th class="px-4 py-3 text-left font-semibold">Keluhan</th>
                <th class="px-4 py-3 text-left font-semibold">Dokter</th>
                <th class="px-4 py-3 text-left font-semibold">Metode Pembayaran</th>
                <th class="px-4 py-3 text-left font-semibold">Asuransi</th>
                <th class="px-4 py-3 text-left font-semibold">Tanggal Kunjungan</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (empty($kunjungan)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                        Belum ada data kunjungan pasien
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($kunjungan as $k): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($k['nama_pasien']) ?></td>
                        <td class="px-4 py-3"><?= esc($k['nama_unit']) ?></td>
                        <td class="px-4 py-3"><?= esc($k['keluhan']) ?></td>
                        <td class="px-4 py-3"><?= esc($k['nama_dpjp']) ?></td>
                        <td class="px-4 py-3"><?= esc($k['metode_pembayaran']) ?></td>
                        <td class="px-4 py-3"><?= esc($k['nama_asuransi']) ?></td>
                        <td class="px-4 py-3"><?= esc($k['tanggal_kunjungan']) ?></td>
                        <td class="px-4 py-3 text-center">
                            <a href="<?= base_url('/kunjungan/edit/' . $k['id']) ?>" class="text-blue-600 hover:bg-gray-200 p-2 rounded-lg btnEdit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>

                            <a href="#"
                                class="btn-delete text-red-600 hover:bg-gray-200 p-2 rounded-lg ml-3"
                                data-id="<?= $k['id'] ?>">
                                <i class="bi bi-trash text-lg"></i>
                            </a>

                            <form id="delete-form-<?= $k['id'] ?>"
                                action="<?= base_url('/kunjungan/delete/' . $k['id']) ?>"
                                method="post"
                                style="display:none;">
                                <?= csrf_field() ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-10">
    <?= $pager->links('kunjungan', 'pagination') ?>
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

<script>
    document.querySelector('form').addEventListener('submit', function() {
        setTimeout(() => {
            document.getElementById('keyword').value = '';
        }, 100);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const id = this.dataset.id;

                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>



<?= $this->endSection() ?>