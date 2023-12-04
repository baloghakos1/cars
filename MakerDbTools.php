<?php
class MakerDbTools {
    private $mysqli;

    function __construct($host = 'localhost', $user = 'root', $password = null, $db = 'cars') {
        $this->mysqli = new mysqli($host, $user, $password, $db);
        if($this->mysqli->connect_errno) {
            throw new Exception($this->mysqli->connect_errno);
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    function insertMakers($makers, $truncate = false) {
        if($truncate) {
            $this->mysqli->query("TRUNCATE TABLE makers");
        }
        foreach ($makers as $maker) {
            $result = $this->mysqli->query("INSERT INTO makers (name) Values ('$maker')");
        }
        return $result;
    }

    function updateMakers($data) {
        $makerName = $data['name'];
        $result = $this->mysqli->query("UPDATE makers SET name=$makerName");
    
        if (!$result) {
            echo "Hiba történt a $makerName beszúrása közben";
            return $result;
        }
    
        $maker = getMakerByName($makerName);
    
        return $maker;
    }
    
    function getMaker($mysqli, $id) {
        $result = $this->mysqli->query("SELECT * FROM makers Where id=$id");
        $maker = $result->fetch_assoc();
    
        return $maker;
    }
    
    function getMakerByName($name) {
        $result = $this->mysqli->query("SELECT * FROM makers Where name=$name");
        $maker = $result->fetch_assoc();
    
        return $maker;
    }
    
    function delMaker($id) {
        $result = $this->mysqli->query("DELETE makers Where id=$id");
    
        return $result;
    }
    
    function getAllMakers() {
        $result = $this->mysqli->query("SELECT * FROM makers");
        $makers = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
    
        return $makers;
    }
}
    
?>