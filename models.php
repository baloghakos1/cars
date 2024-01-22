<?php
session_start();
ini_set('memory_limit','-1');
require_once 'dbmaker.php';
require_once 'page.php';

include 'html-head.php';

$carMaker = new DBMaker();
$isEmptyDb = $carMaker->getCount() == 0;
$csvData = $carMaker->getAll();

echo "<body>";
    include 'html-nav.php';
    echo "<h1>Modellek</h1>";
    page::showExportImportButtons($isEmptyDb);
    Page::showMakersDropdown($csvData);

    

echo"</body>";

?>