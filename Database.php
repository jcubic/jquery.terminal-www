<?php

class Database {
    function __construct() {
        $this->db = new PDO('sqlite:messages.sqlite');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // -------------------------------------------------------------------------
    // :: function check if table exists in SQLite databse file
    // -------------------------------------------------------------------------
    public function table_exists($table) {
        $data = $this->query("SELECT name FROM sqlite_master WHERE type=" .
                             "'table' AND name = ?", array($table));
        return count($data) > 0;
    }
    // -------------------------------------------------------------------------
    // :: universal query database function that return data or
    // :: numer of rows affected
    // -------------------------------------------------------------------------
    function query($query, $data = null) {
        if ($data == null) {
            $res = $this->db->query($query);
        } else {
            $res = $this->db->prepare($query);
            if ($res) {
                if (!$res->execute($data)) {
                    throw Exception("execute query failed");
                }
            } else {
                throw Exception("wrong query");
            }
        }
        if ($res) {
            $re = "/^\s*INSERT|UPDATE|DELETE|ALTER|CREATE|DROP/i";
            if (preg_match($re, $query)) {
                return $res->rowCount();
            } else {
                return $res->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            throw new Exception("Coudn't open file");
        }
    }
}


?>
