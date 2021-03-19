<?php

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require __DIR__ . '/vendor/autoload.php';

$inputDir = __DIR__ . '/in';
$outputDir = __DIR__ . '/out';

$files = glob($inputDir . '/*.csv');

$count = count($files);

echo "Found $count files inside input directory", PHP_EOL;
echo 'Converting...', PHP_EOL, PHP_EOL, '-----', PHP_EOL, PHP_EOL;

$i = 1;

foreach ($files as $filename) {
    echo "[$i / $count] Converting file $filename... ";

    $input = new Csv;
    $spreadsheet = $input->load($filename);

    $savepath = pathinfo($filename, PATHINFO_FILENAME);

    $output = new Xlsx($spreadsheet);
    $output->save($savepath);

    echo '[OK]', PHP_EOL;
}