<?php
session_start();
ini_set('memory_limit','-1');
require_once 'dbmaker.php';
require_once 'page.php';

include 'html-head.php';

$carMaker = new DBMaker();
$isEmptyDb = $dbmodel->getCount($idMaker) == 0;
$csvData = $carMaker->getAll();

$idMaker = 0;
if (isset($_GET['reset'])) {
    unset($_SESSION['$ch']);
    unset($_SESSION['id_maker']);
}
if (isset($_GET['id-maker'])) {
    $idMaker = $_GET['id-maker'];
    $_SESSION['id_maker'] = $idMaker;
    unset($_SESSION['ch']);
}
if (isset($_POST['makers-dropdown'])) {
    $idMaker = $_POST['makers-dropdown'];
    $_SESSION['id-maker'] = $idMaker;
    unset($_SESSION['ch']);
}

if (isset($_SESSION['id_maker'])) {
    $idMaker = $_SESSION['id_maker'];
}

?>