<?php
$cars = [

];
$a = "car-db.csv";
if(file_exists($a)) {
    $myfile = fopen("car-db.csv", "r");
    fgetcsv($myfile);
    $b = "";
    $model = [];
    $make = [];
    $q = "";
    for($i = 0; $i < 70824; $i++) {
        $z = fgetcsv($myfile);
        if($z[1] != $b) {
            array_push($cars, $model);
            array_push($make, $q);
        }
        if($z[1] != $b) {
            $model = [];
            $q = $z[1];
        }
        array_push($model, $z[2]);
        $b = $z[1];
    }
    /*
    for($i = 1; $i < count($make); $i++) {
        echo $make[$i];
        echo ": ";
        for($j = 0; $j < count($cars[$i]); $j++) {
            echo " ";
            echo $cars[$i][$j];
        }
        echo "\n\n\n";
    }
    */
    print_r($cars);
    print_r($make);
}
?>