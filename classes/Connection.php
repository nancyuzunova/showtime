<?php

class Connection{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "showtime";

    function connect(){
        return mysqli_connect($this->host, $this->username, $this->password, $this->db);
    }

    function read($query){
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        if (!$result){
            return false;
        } else {
            $data = false;
            while ($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
            return $data;
        }
    }

    function write($query){
        $conn = $this->connect();
        return mysqli_query($conn, $query);
    }
}