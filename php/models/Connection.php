<?php

class data_conn
{
    private $db_name = "asteleco_personal";
    private $db_user = "asteleco_root";
    private $db_pass = "@%rHW6RQDMA$?jMh";
    //private $db_host = "localhost";
    private $db_host = "209.59.139.150";

    private $db_conn;
    public function dbConn()
    {
        try {
            $this->db_conn = new PDO("mysql:host={$this->db_host}; dbname={$this->db_name}; charset=utf8", $this->db_user, $this->db_pass);
            $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected";
        } catch (PDOException $e) {
            echo "ERROR" . $e->getMessage();
        }
        return $this->db_conn;
    }
}


/* class data_conn
{
    private $db_name = "asteleco_personal";
    private $db_user = "asteleco_root";
    private $db_pass = "Jp~5US_dXyIe";
    private $db_host = "localhost";

    private $db_conn;
    public function dbConn()
    {
        try {
            $this->db_conn = new PDO("mysql:host={$this->db_host}; dbname={$this->db_name}; charset=utf8", $this->db_user, $this->db_pass);
            $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected";
        } catch (PDOException $e) {
            echo "ERROR" . $e->getMessage();
        }
        return $this->db_conn;
    }
} */