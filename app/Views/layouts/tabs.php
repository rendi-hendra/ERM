<div class="text-sm font-medium text-center text-gray-700 border-b border-gray-200 mb-10">
    <?php
    $uri = service('uri')->getSegment(3);
    ?>

    <ul class="flex flex-wrap -mb-px justify-center md:justify-start">
        <li class="me-2">
            <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/soap') ?>"
                class="inline-block p-4 pb-3 border-b-2 rounded-t-lg transition-all duration-200 <?= tabActive('soap', $uri) ?>">
                SOAP
            </a>
        </li>

        <li class="me-2">
            <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/pemeriksaan') ?>"
                class="inline-block p-4 pb-3 border-b-2 rounded-t-lg transition-all duration-200 <?= tabActive('pemeriksaan', $uri) ?>">
                Pemeriksaan
            </a>
        </li>

        <li class="me-2">
            <a href="<?= base_url('/kunjungan/' . $kunjunganId . '/resep') ?>"
                class="inline-block p-4 pb-3 border-b-2 rounded-t-lg transition-all duration-200 <?= tabActive('resep', $uri) ?>">
                Resep
            </a>
        </li>
    </ul>
</div>