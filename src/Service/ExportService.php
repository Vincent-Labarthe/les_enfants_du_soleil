<?php

namespace App\Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportService
{
    /**
     * @param string     $type
     * @param array|null $queryParam
     *
     * @return void
     */
    public function generateExport(string $type,array $queryParam = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $this->generateCSVHeader($sheet, $type);
    }

    /**
     * Generate CSV file header
     *
     * @param $sheet
     * @param $type
     */
    private function generateCSVHeader($sheet, $type): void
    {

    }
}