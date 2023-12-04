<?php
function insertMakers($mysqli, $makers, $truncate = false) {
    if($truncate) {
        $mysqli->query("TRUNCATE TABLE makers");
    }
    foreach ($makers as $maker) {
        $result = $mysqli->query("INSERT INTO makers (name) Values ('$maker')");
    }
    return $result;
}

function updateMakers($mysqli, $data) {
    $result = $mysqli->query("UPDATE makers SET {$data['name']}");

    if (!$result) {
        echo "Hiba történt a $maker beszúrása közben";
        return $result;
    }

    return $result;
}

function getMaker($mysqli, $id) {
    
}
?>
