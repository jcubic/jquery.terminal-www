<?php
/*
 * This file is part of Simple PHP Chat
 * Released under MIT License
 *
 * https://github.com/jcubic/chat/tree/notifications
 *
 * Copyright (c) 2019 Jakub T. Jankiewicz
 */

require_once('Database.php');
require_once('http.php'); // get and post functions using curl

class Notification {
    public function __construct() {
        $this->db = new Database(); // wrapper over PDO and SQLite
        if (!$this->table_exists('users')) {
            $this->query("CREATE TABLE users(id INTEGER NOT NULL PRIMARY KEY".
                         " AUTOINCREMENT, username VARCHAR(300))");
        }
        if (!$this->table_exists('tokens')) {
            $this->query("CREATE TABLE tokens(userid INTEGER, token VARCHAR" .
                         "(256), FOREIGN KEY (userid) REFERENCES users (id))");
        }
        $this->server_token = file_get_contents('firebase_token');
    }
    // -------------------------------------------------------------------------
    // :: forward every missing method to database object
    // -------------------------------------------------------------------------
    public function __call($name, $args) {
        return call_user_func_array(array($this->db, $name), $args);
    }
    // -------------------------------------------------------------------------
    // :: get id of a user. If user don't exist create one
    // -------------------------------------------------------------------------
    private function get_user_id($username) {
        $ret = $this->query("SELECT * FROM users WHERE username = ?", array($username));
        if (count($ret) == 1) {
            return $ret[0]['id'];
        }
        $this->query("INSERT INTO users(username) values (?)", array($username));
        return $this->lastInsertId();
    }
    // -------------------------------------------------------------------------
    // :: return token for the userid
    // -------------------------------------------------------------------------
    private function token($id) {
        $arr = $this->query("SELECT token FROM tokens WHERE userid = ?", array($id));
        return count($arr) > 0;
    }
    // -------------------------------------------------------------------------
    // :: register new token if there is not already registered
    // -------------------------------------------------------------------------
    public function register($username, $token) {
        $id = $this->get_user_id($username);
        if ($this->token($id)) {
            $this->query("DELETE FROM tokens WHERE userid = ?", array($id));
        }
        $this->query("INSERT INTO tokens(userid, token) VALUES(?, ?)",
                     array($id, $token));
    }
    // -------------------------------------------------------------------------
    // :: send push notification using Firebase to all registered users
    // -------------------------------------------------------------------------
    public function send($username, $message) {
        $rows = $this->query("SELECT * FROM tokens");
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $payload = array(
                    "notification" => array(
                        "title" => "Simple CHAT",
                        "body" => "$username: $message",
                        "icon" => "https://jcubic.pl/chat/icon.png"
                    ),
                    "to" => $row['token']
                );
                $headers = array(
                    "Content-Type: application/json",
                    "Authorization: key=" . $this->server_token
                );
                $res = post(
                    'https://fcm.googleapis.com/fcm/send',
                     json_encode($payload),
                     $headers
                );
                if (__DEBUG__) {
                    $file = fopen('firebase.log', 'a');
                    fwrite($file, $res);
                    fclose($file);
                }
            }
        }
    }
}
  
