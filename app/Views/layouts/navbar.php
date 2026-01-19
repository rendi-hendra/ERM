<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        <div class="flex items-center space-x-2">
            <div class="bg-blue-600 text-white p-2 px-4 rounded-xl flex items-center justify-center">
                <i class="bi bi-heart-pulse text-lg"></i>
            </div>
            <span class="text-lg font-semibold text-gray-900">Sistem ERM</span>
        </div>

        <?php
        $uri = service('uri')->getSegment(1);
        function navActive($segment, $uri)
        {
            return $uri === $segment
                ? 'text-blue-600 font-medium bg-blue-50 px-3 py-1.5 rounded-lg'
                : 'text-gray-700 hover:text-blue-600';
        }
        ?>

        <div class="flex items-center space-x-6 text-sm">
            <a href="<?= base_url('pasien') ?>"
                class="flex items-center <?= navActive('pasien', $uri) ?>">
                <i class="fa-solid fa-users mr-2"></i> Master Pasien
            </a>

            <a href="<?= base_url('asuransi') ?>"
                class="flex items-center <?= navActive('asuransi', $uri) ?>">
                <i class="fa-solid fa-building-columns mr-2"></i> Master Asuransi
            </a>

            <a href="<?= base_url('unit') ?>"
                class="flex items-center <?= navActive('unit', $uri) ?>">
                <i class="bi bi-hospital-fill mr-2"></i> Master Unit
            </a>

            <a href="<?= base_url('employees') ?>"
                class="flex items-center <?= navActive('employees', $uri) ?>">
                <i class="bi bi-people-fill mr-2"></i> Master Employees
            </a>

            <a href="<?= base_url('kunjungan') ?>"
                class="flex items-center <?= navActive('kunjungan', $uri) ?>">
                <i class="bi bi-person-plus-fill mr-2"></i> Pendaftaran Kunjungan
            </a>
        </div>

        <div class="flex items-center space-x-3">
            <div class="text-right leading-tight">
                <div class="text-sm font-semibold text-gray-800"><?= session()->get('nama') ?></div>
                <div class="text-xs text-gray-500"><?= session()->get('role') ?></div>
            </div>
            <a href="#"
                class="flex items-center border border-gray-300 px-3 py-1.5 rounded-lg text-gray-700 hover:bg-gray-100 btn-logout"
                data-url="<?= base_url('logout') ?>">
                <i class="bi bi-box-arrow-right mr-2"></i>
                <span class="font-semibold">Logout</span>
            </a>
        </div>

    </div>
</nav>