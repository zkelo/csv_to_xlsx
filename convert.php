<?php

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require __DIR__ . '/vendor/autoload.php';

$inputDir = __DIR__ . '/in';
$outputDir = __DIR__ . '/out';

$files = glob($inputDir . '/*.csv');

foreach ($files as $filename) {
    $input = new Csv;
    $spreadsheet = $input->load($filename);

    $savepath = pathinfo($filename, PATHINFO_FILENAME);

    $output = new Xlsx($spreadsheet);
    $output->save($savepath);
}