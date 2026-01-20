<?php

function generatePlan(array $resepDetails): string
{
    if (empty($resepDetails)) {
        return '- Belum ada rencana terapi -';
    }

    $lines   = [];

    foreach ($resepDetails as $row) {
        $obat = trim(
            $row['nama'] . ' ' .
                $row['sediaan'] . ' ' .
                $row['kekuatan']
        );

        $lines[] = "- {$obat}, {$row['aturan_pakai']}";
    }

    return implode("\n", $lines);
}
