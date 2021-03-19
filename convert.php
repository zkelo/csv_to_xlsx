<?php

ini_set('memory_limit', '128M');

use Kodus\Cache\FileCache;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require __DIR__ . '/vendor/autoload.php';

$inputDir = __DIR__ . '/in';
$outputDir = __DIR__ . '/out';
$cacheDir = __DIR__ . '/.cache';

$files = glob($inputDir . '/*.csv');

$count = count($files);

if (!$count) {
    echo 'Input directory is empty', PHP_EOL;
    exit;
}

echo "Found $count files inside input directory", PHP_EOL, PHP_EOL;

echo 'Preparing...', PHP_EOL, '-----', PHP_EOL;

$cleanDirs = [
    $outputDir
];
$cleanDirsCount = count($cleanDirs);

$i = 1;

foreach ($cleanDirs as $name) {
    echo "[$i / $cleanDirsCount] Cleaning up $name directory... ";

    $dirFiles = glob(__DIR__ . "/$name/*");
    array_walk($dirFiles, function ($path) {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (in_array($extension, ['gitignore', 'gitkeep'])) {
            return;
        }

        unlink($path);
    });

    echo '[OK]', PHP_EOL;
}

$cache = new FileCache($cacheDir, 86400);

echo 'Cleaning up cache... ';
$cache->clear();

echo ' [OK]', PHP_EOL;
Settings::setCache($cache);

echo PHP_EOL, 'Converting...', PHP_EOL, '-----', PHP_EOL;

$i = 1;

foreach ($files as $filename) {
    $name = pathinfo($filename, PATHINFO_FILENAME);
    echo "[$i / $count] Converting file $name... ";

    $input = new Csv;
    $spreadsheet = $input->load($filename);

    $savepath = pathinfo($filename, PATHINFO_FILENAME);

    $output = new Xlsx($spreadsheet);
    $output->save($savepath);

    echo '[OK]', PHP_EOL;
}

echo PHP_EOL, 'Your files has been converted successfully!', PHP_EOL;