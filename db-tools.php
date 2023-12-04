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
?>