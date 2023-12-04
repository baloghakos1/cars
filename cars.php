<?php
$cars = [

];
$a = "car-db.csv";
if(file_exists($a)) {
    $myfile = fopen("car-db.csv", "r");
    fgetcsv($myfile);
    $b = null;
    $model = [];
    $make = [];
    $q = "";
    for($i = 0; $i < 70824; $i++) {
        $z = fgetcsv($myfile);
        if($z) {
            if(($z[1] != $b) && !is_null($b)) {
                //array_push($cars, $model);
                //array_push($make, $q);
                $cars[] = $model;
                $make[] = $q;
            }
            if($z[1] != $b) {
                $model = [];
                $q = $z[1];
            }
            array_push($model, $z[2]);
            $b = $z[1];
        }
        else {
            $cars[] = $model;
            $make[] = $q;
        }
    }
    fclose($myfile);
    echo "\n";
    //print_r($cars);
    //print_r($make);
    //print_r(GetMakers());
}

function GetMakers() {
    $a = fopen("car-db.csv", "r");
    fgetcsv($a);
    $b = null;
    $make = [];
    $q = "";
    for($i = 0; $i < 70824; $i++) {
        $z = fgetcsv($a);
        if($z) {
            if($z[1] != $b && !is_null($b)) {
                $make[] = $q;
            }
            if($z[1] != $b) {
                $q = $z[1];
            }
            $b = $z[1];
        }
        else {
            $make[] = $q;
        }
        
    }
    fclose($a);
    return $make;
}

$mysqli = new mysqli("localhost","root",null,"cars");
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
$makers = GetMakers();
echo "connected\n";
$mysqli->query("TRUNCATE TABLE makers");
foreach($makers as $maker) {
    $mysqli->query("INSERT INTO makers (name) Values ('$maker')");
    echo "$maker\n";
}
$mysqli->close();
?>