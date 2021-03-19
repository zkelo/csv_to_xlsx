# CSV to XLSX

This script can convert amount of CSV files into XLSX. Based on PhpSpreadsheet.

## Installation

1. Clone this repository;
2. Run `composer install`.

## Usage

1. Put your CSV files into directory named `in` located in this repository;
2. Run `php convert.php`;
3. Wait till the end;
4. Grab XLSX files from `out` directory.

### RAM usage

By default, script setting up a `4G` memory limit for itself. You can increase (or decrease) it by your needs.

### Caching

Script uses file cache.

## Third party packages

Script uses following packages:

- [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) - main dependency for working with spreadsheets;
- [file-cache](https://github.com/kodus/file-cache) - cache package that follows a PSR 16 standard.