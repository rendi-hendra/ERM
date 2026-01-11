<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-2">Master Unit</h1>
<p class="text-gray-500 mb-6">Kelola data unit rumah sakit</p>

<div class="flex justify-between items-center mb-4">
    <form method="get" action="<?= base_url('unit') ?>" class="inline-flex w-1/2">
        <input type="text" name="keyword" placeholder="Cari berdasarkan nama atau kategori"
            value="<?= esc($keyword ?? '') ?>"
            class="w-1/2 border border-gray-300 rounded-l-xl px-4 py-2">
        <button type="submit"
            class="bg-gray-900 text-white px-5 py-2 rounded-r-xl hover:bg-gray-700"><i class="bi bi-search"></i></button>
    </form>

    <a href="<?= base_url('/unit/create') ?>" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        <i class="bi bi-person-plus mr-1"></i> Tambah Unit
    </a>
</div>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (empty($unit)): ?>
                <tr>
                    <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                        Belum ada data unit
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($unit as $u): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($u['nama']) ?></td>
                        <td class="px-4 py-3"><?= esc($u['kategori']) ?></td>
                        <td class="px-4 py-3 text-center">
                            <a href="<?= base_url('/unit/edit/' . $u['id']) ?>" class="text-blue-600 hover:bg-gray-200 p-2 rounded-lg btnEdit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>

                            <a href="#"
                                class="btn-delete text-red-600 hover:bg-gray-200 p-2 rounded-lg ml-3"
                                data-id="<?= $u['id'] ?>">
                                <i class="bi bi-trash text-lg"></i>
                            </a>

                            <form id="delete-form-<?= $u['id'] ?>"
                                action="<?= base_url('/unit/delete/' . $u['id']) ?>"
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
    <?= $pager->links('unit', 'pagination') ?>
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
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const unitId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + unitId).submit();
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection() ?>