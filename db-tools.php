<?php
function insertMakers($mysqli, $makers, $truncate = false) {
    if($truncate) {
        $mysqli->query("TRUNCATE TABLE {self::DBTABLE};");
    }
    foreach ($makers as $maker) {
        $result = $mysqli->query("INSERT INTO {self::DBTABLE} (name) Values ('$maker')");
    }
    return $result;
}

function updateMakers($mysqli, $data) {
    $makerName = $data['name'];
    $result = $mysqli->query("UPDATE {self::DBTABLE} SET name=$makerName");

    if (!$result) {
        echo "Hiba történt a $makerName beszúrása közben";
        return $result;
    }

    $maker = getMakerByName($mysqli, $makerName);

    return $maker;
}

function getMaker($mysqli, $id) {
    $result = $mysqli->query("SELECT * FROM {self::DBTABLE} Where id=$id;");
    $maker = $result->fetch_assoc();

    return $maker;
}

function getMakerByName($mysqli, $name) {
    $result = $mysqli->query("SELECT * FROM {self::DBTABLE} Where name=$name;");
    $maker = $result->fetch_assoc();

    return $maker;
}

function delMaker($mysqli, $id) {
    $result = $mysqli->query("DELETE {self::DBTABLE} Where id=$id;");

    return $result;
}

function getAllMakers($mysqli) {
    $result = $mysqli->query("SELECT * FROM {self::DBTABLE};");
    $makers = $result->fetch_all(MYSQLI_ASSOC);
    $result->free_result();

    return $makers;
}


?>
