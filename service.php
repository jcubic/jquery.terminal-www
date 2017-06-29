<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require('json-rpc.php');
require('utils.php');

/*
   create table jq_comments(date datetime, nick Varchar(100), email varchar(50), www varchar(255), comment text, ip INT UNSIGNED);

   INET_NTOA(number)
   INET_ATON('127.0.0.1')

 */


class Service {
    public function login($user, $passwd) {
        if (strcmp($user, 'foo') == 0 && strcmp($passwd, 'bar') == 0) {
            // If you need to handle more than one user you can create
            // new token and save it in database
            // UPDATE users SET token = '$token' WHERE name = '$user'
            return md5($user . ":" . $passwd);
        } else {
            throw new Exception("Wrong Password");
        }
    }


    // ------------------------------------------------------------------------
    function jargon_list() {
        $db = new PDO('sqlite:jargon.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $res = $db->query("SELECT term FROM terms");
        if ($res) {
            return array_map(function($term) {
                return $term['term'];
            }, $res->fetchAll());
        } else {
            return array();
        }
    }
    
    public function get($url) {
        $curl = $this->curl($url);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
    // ------------------------------------------------------------------------
    private function curl($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
        } else {
            // defaut FireFox 15 from agent switcher (google chrome extension)
            $agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 '.
                     'Firefox/15.0a1';
        }
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return $ch;
    }

    // ------------------------------------------------------------------------
    function jargon_search($search_term) {
        $db = new PDO('sqlite:jargon.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $search_term = $db->quote($search_term);
        $res = $db->query("SELECT term FROM terms WHERE term like $search_term or ".
                          "def like $search_term");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    // ------------------------------------------------------------------------
    function jargon($search_term) {
        $db = new PDO('sqlite:jargon.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $search_term = $db->quote($search_term);
        $res = $db->query("SELECT * FROM terms WHERE term like $search_term");
        $result = array();
        if ($res) {
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as &$term) {
                $query = "SELECT name FROM abbrev WHERE term = " . $term['id'];
                $res = $db->query($query);
                if ($res) {
                    $abbr_array = $res->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($abbr_array)) {
                        foreach ($abbr_array as $abbr) {
                            $term['abbr'][] = $abbr['name'];
                        }
                    }
                }
            }
        }
        return $result;
    }

    // ------------------------------------------------------------------------
    public function rfc($number) {
        if ($number == null) {
            $url = "http://www.rfc-editor.org/in-notes/rfc-index.txt";
            $page = $this->get($url);
            $page = preg_replace("/(^[0-9]+)/m", '[[bu;#fff;;rfc]$1]', $page);
            return $page;
        } else {
            $number = preg_replace("/^0+/", "", $number);
            $url = "https://www.rfc-editor.org/rfc/rfc$number.txt";
            return $this->get($url);
        }
    }

    // ------------------------------------------------------------------------
    public function sign_for_newsletter($email) {
        connect();
        $email = mysql_real_escape_string($email);
        $query = "INSERT INTO jq_newsletter VALUES('$email')";
        if (!mysql_query($query)) {
            throw new Exception("MySQL Error: " . mysql_error());
        }
        return true;
    }

    // ------------------------------------------------------------------------
    public function add_comment($nick, $email, $www, $comment) {
        $conn = connect();
        $nick = mysqli_real_escape_string($conn, strip_tags($nick));
        $email = mysqli_real_escape_string($conn, strip_tags($email));
        if (preg_match("/http:\/\/.*\..*/", $www)) {
            $www = mysqli_real_escape_string($conn, strip_tags($www));
        } else {
            $www = '';
        }
        $comment = strip_tags($comment);
        $comment = mysqli_real_escape_string($conn, $comment);

        $ip = $_SERVER['REMOTE_ADDR'];

        $hash = md5($email);
        $fname = "avatars/$hash.png";
        if (!file_exists($fname)) {
            try {
                $data = @file_get_contents('https://www.gravatar.com/avatar/' . $hash . '?d=404&s=48');
                $file = fopen($fname, "w");
                if (!$file) {
                    throw new Exception("IO Error: Can't open file avatars/$hash.png");
                }
                fwrite($file, $data);
                fclose($file);
            } catch(Exception $e) {
                $fname = "avatars/default.png";
            }
        }
        $query = "INSERT INTO jq_comments(date, nick, email, www, comment, ip, avatar)
              VALUES (now(), '$nick', '$email', '$www',
              '$comment', INET_ATON('$ip'), '$fname')";
        if (!mysqli_query($conn, $query)) {
            throw new Exception("MySQL Error: " . mysql_error());
        }
        return $fname;
    }

    // ------------------------------------------------------------------------
    public function fix_avatars() {
        $conn = connect();
        $array = mysql_array("SELECT distinct md5(email), email from jq_comments");
        foreach ($array as $row) {
            $email = $row[1];
            $data = file_get_contents('http://www.gravatar.com/avatar/' . $row[0] . '.png?d=404&s=48');
            if ($data) {
                $avatar = "avatars/" . $row[0] . ".png";
                $file = fopen($avatar, "w");
                if (!$file) {
                    throw new Exception("IO Error: Can't open file $avatar");
                }
                fwrite($avatar, $data);
                fclose($file);
            } else {
                $avatar = "avatars/default.png";
            }
            $avatars[] = array($avatar, str_len($data));
            if (!mysqli_query($conn, "UPDATE jq_comments set avatar = '$avatar' where email = '$email'")) {
                throw new Exception("Can't update ${row[1]}");
            }
        }
        return $avatars;
    }

    // ------------------------------------------------------------------------
    public function get_comments() {
        connect();
        $query = "SELECT DATE_FORMAT(date, '%d-%m-%Y'), nick, avatar, www,
              comment, id from jq_comments order by date";
        return mysqli_array($query);
    }

    // ------------------------------------------------------------------------
    public function ls($token, $path) {
        // you can select token from database
        if (strcmp(md5("foo:bar"), $token) == 0) {
            $dir = opendir($path);
            while($name = readdir($dir)) {
                $fname = $path."/".$name;
                if (!is_dir($name) && !is_dir($fname)) {
                    $list[] = $name;
                }
            }
            closedir($dir);
            return $list;
        } else {
            throw new Exception("Access Denied");
        }
    }

    // ------------------------------------------------------------------------
    //can't use echo
    public function _echo($ignore, $str) {
        return $str;
    }
    // ------------------------------------------------------------------------
    public function ping($ignore) {
        return "pong";
    }

}

handle_json_rpc(new Service());

?>
