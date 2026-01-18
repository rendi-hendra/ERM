<h1 class="text-2xl font-bold mb-2 mt-12">Employees</h1>
<div class="flex justify-between items-center mb-4">
    <form method="get" action="<?= base_url('unit/edit/' . $unit['id']) ?>" class="inline-flex w-1/2">
        <input type="text" name="keyword" id="keyword" placeholder="Cari berdasarkan nama atau no SIP"
            value="<?= esc($keyword ?? '') ?>"
            class="w-1/2 border border-gray-300 rounded-l-xl px-4 py-2">
        <button type="submit"
            class="bg-gray-900 text-white px-5 py-2 rounded-r-xl hover:bg-gray-700"><i class="bi bi-search"></i></button>
    </form>

    <button
        id="createEmpOnUnit"
        data-mode="create"
        data-unit-id="<?= $unit['id'] ?>"
        data-modal-target="crud-modal"
        data-modal-toggle="crud-modal"
        class="text-white rounded-lg bg-gray-900 px-4 py-2.5">
        <i class="bi bi-person-plus mr-1"></i> Tambah Employee
    </button>


</div>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">No. SIP</th>
                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                <th class="px-4 py-3 text-left font-semibold">Jenis</th>
                <th class="px-4 py-3 text-left font-semibold">No. HP</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (empty($employeeOnUnit)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                        Belum ada data employee pada unit ini.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($employeeOnUnit as $e): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($e['sip']) ?></td>
                        <td class="px-4 py-3"><?= esc($e['nama_employee']) ?></td>
                        <td class="px-4 py-3"><?= esc($e['jenis']) ?></td>
                        <td class="px-4 py-3"><?= esc($e['no_hp']) ?></td>
                        <td class="px-4 py-3 text-center">
                            <button
                                class="btn-edit-emp text-blue-600 hover:bg-gray-200 p-2 rounded-lg"
                                data-mode="edit"
                                data-unit-id="<?= $e['unit_id'] ?>"
                                data-emp-on-unit-id="<?= $e['id'] ?>"
                                data-employee-id="<?= $e['emp_id'] ?>"
                                data-modal-target="crud-modal"
                                data-modal-toggle="crud-modal">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </button>

                            <a href="<?= base_url('unit/' . $e['unit_id'] . '/emp-on-unit/delete/' . $e['id']) ?>"
                                class="btn-delete-asuransi text-red-600 hover:bg-gray-200 p-2 rounded-lg ml-3"
                                data-unit="<?= $e['unit_id'] ?>"
                                data-id="<?= $e['id'] ?>">
                                <i class="bi bi-trash text-lg"></i>
                            </a>

                            <form id="delete-form-<?= $e['unit_id'] ?>-<?= $e['id'] ?>"
                                action="<?= base_url('unit/' . $e['unit_id'] . '/emp-on-unit/delete/' . $e['id']) ?>"
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

<?= view('unit/emp_on_unit/form.php') ?>

<div class="mt-10">
    <?= $pager->links('emp_on_unit', 'pagination') ?>
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
        document.querySelectorAll('.btn-delete-asuransi').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const unitId = this.dataset.unit;
                const employeeId = this.dataset.id;

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
                        document
                            .getElementById(`delete-form-${unitId}-${employeeId}`)
                            .submit();
                    }
                });
            });
        });
    });
</script>