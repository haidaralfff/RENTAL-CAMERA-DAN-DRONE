<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('export_to_excel')) {
    /**
     * Export data to Real Excel Format (via HTML Table)
     */
    function export_to_excel($filename, $headers, $data, $metadata = [])
    {
        // Headers for Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Start HTML Table
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style>
                .text { mso-number-format:"\@"; }
                .header { background-color: #2563EB; color: #ffffff; font-weight: bold; }
                .title { font-size: 20px; font-weight: bold; }
                td { border: 0.5pt solid #E2E8F0; padding: 5px; }
              </style></head><body>';

        echo '<table>';
        
        // Title & Metadata
        if (!empty($metadata['title'])) {
            echo '<tr><td colspan="'.count($headers).'" class="title">'.strtoupper($metadata['title']).'</td></tr>';
        }
        if (!empty($metadata['subtitle'])) {
            echo '<tr><td colspan="'.count($headers).'">'.$metadata['subtitle'].'</td></tr>';
        }
        echo '<tr><td colspan="'.count($headers).'">Tanggal Cetak: ' . date('d F Y H:i') . '</td></tr>';
        echo '<tr></tr>'; // Spacer

        // Table Headers
        echo '<tr>';
        foreach ($headers as $h) {
            echo '<td class="header">' . $h . '</td>';
        }
        echo '</tr>';

        // Data Rows
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                // Gunakan class .text agar angka/ID tidak berubah format (misal ID #6 tetap jadi #6)
                echo '<td class="text">' . $cell . '</td>';
            }
            echo '</tr>';
        }

        // Footer
        if (!empty($metadata['footer'])) {
            echo '<tr></tr>';
            foreach ($metadata['footer'] as $fRow) {
                echo '<tr>';
                foreach ($fRow as $fCell) {
                    echo '<td style="font-weight:bold">' . $fCell . '</td>';
                }
                echo '</tr>';
            }
        }

        echo '</table></body></html>';
        exit;
    }
}
