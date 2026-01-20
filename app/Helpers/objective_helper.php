<?php

function generateObjective(array $p): string
{
    $lines = [];

    if (!empty($p['suhu'])) {
        $lines[] = "Suhu tubuh: {$p['suhu']} °C";
    }

    if (!empty($p['td_sistolik']) && !empty($p['td_diastolik'])) {
        $lines[] = "Tekanan darah: {$p['td_sistolik']}/{$p['td_diastolik']} mmHg";
    }

    if (!empty($p['nadi'])) {
        $lines[] = "Nadi: {$p['nadi']} x/menit";
    }

    if (!empty($p['rr'])) {
        $lines[] = "Respirasi: {$p['rr']} x/menit";
    }

    if (!empty($p['berat_badan'])) {
        $lines[] = "Berat badan: {$p['berat_badan']} kg";
    }

    if (!empty($p['tinggi_badan'])) {
        $lines[] = "Tinggi badan: {$p['tinggi_badan']} cm";
    }

    if (!empty($p['catatan'])) {
        $lines[] = "Catatan pemeriksaan: {$p['catatan']}";
    }

    return implode("\n", $lines);
}
