<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg border border-default rounded-base shadow-md p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-default pb-4 md:pb-5">
                <h3 id="modalTitle" class="text-lg font-medium text-heading"></h3>

                <button type="button" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="crud-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="empOnUnitForm" method="post" class="space-y-4 md:space-y-6">
                <div class="">
                    <input type="hidden" name="unit_id" value="<?= esc($unitId ?? old('unit_id')) ?>">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="employee" class="block mb-2.5 text-sm font-medium text-heading">Nama</label>
                        <select id="employee" name="employee" class="">
                        </select>
                        <?php if (session()->getFlashdata('errors')['employee'] ?? false): ?>
                            <p class="mt-2 text-sm text-red-600">
                                <?= session()->getFlashdata('errors')['employee'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="inline-flex items-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 box-border border border-transparent focus:ring-4 focus:ring-blue-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        Simpan
                    </button>
                    <a href="<?= current_url() ?>" class="text-body bg-gray-200 rounded-lg box-border border border-default-medium hover:bg-gray-300 hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modal = document.getElementById('crud-modal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('empOnUnitForm');

        const employeeSelect = new TomSelect("#employee", {
            placeholder: "Pilih employee...",
        });

        function loadEmployees(unitId, selectedId = null, mode = 'create') {
            fetch(`<?= base_url('unit/emp-on-unit/getEmployees') ?>/${unitId}?mode=${mode}&selected=${selectedId}`)
                .then(res => res.json())
                .then(data => {
                    employeeSelect.clearOptions();
                    employeeSelect.enable();

                    if (data.length === 0) {
                        employeeSelect.addOption({
                            value: '',
                            text: 'Tidak ada employee tersedia'
                        });
                        employeeSelect.setValue('');
                        employeeSelect.disable();
                        return;
                    }

                    data.forEach(emp => {
                        employeeSelect.addOption({
                            value: emp.id,
                            text: emp.nama
                        });
                    });

                    if (data.length === 1) {
                        employeeSelect.setValue(data[0].id);
                    }

                    if (selectedId) {
                        employeeSelect.setValue(selectedId);
                    }
                });
        }

        // CREATE
        document.getElementById('createEmpOnUnit')
            ?.addEventListener('click', function() {

                modalTitle.textContent = 'Tambah Data Employee on Unit';
                form.action = `<?= base_url('unit') ?>/${this.dataset.unitId}/emp-on-unit/create`;

                employeeSelect.clear();
                loadEmployees(this.dataset.unitId);
            });

        // EDIT
        document.querySelectorAll('.btn-edit-emp').forEach(btn => {
            btn.addEventListener('click', function() {

                modalTitle.textContent = 'Edit Data Employee on Unit';
                form.action = `<?= base_url('unit') ?>/${this.dataset.unitId}/emp-on-unit/update/${this.dataset.empOnUnitId}`;

                loadEmployees(
                    this.dataset.unitId,
                    this.dataset.employeeId,
                    'edit'
                );
            });
        });

        // VALIDASI ERROR
        <?php if (session()->has('errors')): ?>
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            const unitId = "<?= esc(old('unit_id') ?? '') ?>";
            const employeeId = "<?= esc(old('employee') ?? '') ?>";

            if (unitId) {
                loadEmployees(unitId, employeeId);
            }
        <?php endif; ?>

    });
</script>