<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/tabs') ?>
<h1 class="text-2xl font-bold mb-2">Resep</h1>
<p class="text-gray-500 mb-6">Resep obat</p>

<?php if (empty($resep)): ?>
    <div class="flex justify-end items-center mb-4">
        <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/soap/resep') ?>" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            <i class="bi bi-file-earmark-plus mr-1"></i></i> Tambah Resep
        </a>
    </div>
<?php endif; ?>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                <th class="px-4 py-3 text-left font-semibold">Dokter</th>
                <th class="px-4 py-3 text-left font-semibold">Obat</th>
                <th class="px-4 py-3 text-left font-semibold">Qty</th>
                <th class="px-4 py-3 text-left font-semibold">Catatan</th>
                <!-- <th class="px-4 py-3 text-center font-semibold">Aksi</th> -->
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (empty($resep)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                        Belum ada data resep
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($resep as $r): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($r['created_at']) ?></td>
                        <td class="px-4 py-3"><?= esc($r['employee_name']) ?></td>
                        <td class="px-4 py-3">
                            <?php foreach ($resepDetail[$r['id']] ?? [] as $d): ?>
                                <?= esc($d['nama']) ?> <?= esc($d['kekuatan']) ?><br>
                            <?php endforeach ?>
                        </td>
                        <td class="px-4 py-3">
                            <?php foreach ($resepDetail[$r['id']] ?? [] as $d): ?>
                                <?= esc($d['qty']) ?><br>
                            <?php endforeach ?>
                        </td>
                        <td class="px-4 py-3"><?= esc($r['catatan']) ?? 'Tidak ada catatan' ?></td>
                        <!-- <td class="px-4 py-3 text-center">
                            <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/resep/edit/' . $r['id']) ?>" class="text-blue-600 hover:bg-gray-200 p-2 rounded-lg btnEdit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>

                            <a href="#"
                                class="btn-delete text-red-600 hover:bg-gray-200 p-2 rounded-lg"
                                data-id="<?= $r['id'] ?>"
                                data-kunjungan-id="<?= $kunjunganId ?>">
                                <i class="bi bi-trash text-lg"></i>
                            </a>

                            <form id="delete-form-<?= $kunjunganId ?>-<?= $r['id'] ?>"
                                action="<?= base_url('/kunjungan/' . $kunjunganId . '/resep/delete/' . $r['id']) ?>"
                                method="post"
                                style="display:none;">
                                <?= csrf_field() ?>
                            </form>
                        </td> -->
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
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
                const kunjunganId = this.dataset.kunjunganId;

                console.log(kunjunganId);

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
                        document.getElementById(`delete-form-${kunjunganId}-${id}`).submit();
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection() ?>