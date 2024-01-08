<?php
session_start();
ini_set('memory_limit','-1');
require_once 'dbmaker.php';
require_once 'page.php';

include 'html-head.php';

$carMaker = new DBMaker();
$isEmptyDb = $carMaker->getCount() == 0;

echo "<body>";
    include 'html-nav.php';
    echo "<h1>Gyártók</h1>";
    page::showExportImportButtons($isEmptyDb);

    if (isset($_POST['ch'])) {
        $ch = $_POST['ch'];
        $_SESSION['ch'] = $ch;
    }

    if (isset($_POST['btn-truncate'])) {
        $carMaker->truncate();
        $_SESSION['ch'] = '';
        $makers = [];
        header("Refresh:0");
    }

    if (isset($_POST['btn-del'])) 
    {
        $id = $_POST['btn-del'];
        $carMaker->delete($id);
    }

    if (isset($_POST['input-file'])) {
        require_once('csv-tools.php');
        $fileName = $_POST['input-file'];
        $csvData = getCsvData($fileName);
        if (empty($csvData)) {
            echo "Nem található adat a csv fájlban.";
            return false;
        }
        $makers = getMakers($csvData);
        $errors = [];
        foreach ($makers as $maker) {
            $result = $carMaker->create(['name' => $maker]);
            if (!$result) {
                $errors[] = $maker;
            }
        }
        header("Refresh:0");
    }

    

    if (!$isEmptyDb) {
        page::showSearchBar();
        $abc = $carMaker->getAbc();
        page::showAbcButtons($abc);
    }

    if (!empty($_SESSION['ch'])) {
        $ch = $_SESSION['ch'];
        $makers = $carMaker->getByFirstCh($ch);
        page::showMakersTable($makers);
    }


    

echo "</body>";

include 'html-footer.php';

?>