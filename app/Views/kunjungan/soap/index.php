<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/tabs') ?>
<h1 class="text-2xl font-bold mb-2">SOAP</h1>
<p class="text-gray-500 mb-6">SOAP (Subjective, Objective, Assessment, Plan)</p>

<?php if (empty($soap)): ?>
    <div class="flex justify-end items-center mb-4">
        <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/soap/create') ?>" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            <i class="bi bi-file-earmark-plus mr-1"></i></i> Tambah SOAP
        </a>
    </div>
<?php endif; ?>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                <th class="px-4 py-3 text-left font-semibold">Dokter</th>
                <th class="px-4 py-3 text-left font-semibold">Subjective</th>
                <th class="px-4 py-3 text-left font-semibold">Assessment</th>
                <th class="px-4 py-3 text-left font-semibold">Status</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (empty($soap)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                        Belum ada data SOAP
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($soap as $s): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($s['created_at']) ?></td>
                        <td class="px-4 py-3"><?= esc($s['employee_name']) ?></td>
                        <td class="px-4 py-3"><?= character_limiter($s['subjective'], 50) ?></td>
                        <td class="px-4 py-3"><?= esc($s['assesment'] ?? 'Belum melakukan assessment') ?></td>
                        <td class="px-4 py-3">
                            <?php if ($s['status'] === '0'): ?>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-700">Draft</span>
                            <?php else: ?>
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                    Final
                                </span>
                            <?php endif ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/soap/edit/' . $s['id']) ?>" class="text-blue-600 hover:bg-gray-200 p-2 rounded-lg btnEdit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>

                            <a href="#"
                                class="btn-delete text-red-600 hover:bg-gray-200 p-2 rounded-lg"
                                data-id="<?= $s['id'] ?>"
                                data-kunjungan-id="<?= $kunjunganId ?>">
                                <i class="bi bi-trash text-lg"></i>
                            </a>

                            <form id="delete-form-<?= $kunjunganId ?>-<?= $s['id'] ?>"
                                action="<?= base_url('/kunjungan/' . $kunjunganId . '/soap/delete/' . $s['id']) ?>"
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