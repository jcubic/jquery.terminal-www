<?php

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

  public function sign_for_newsletter($email) {
    connect();
    $email = mysql_real_escape_string($email);
    $query = "INSERT INTO jq_newsletter VALUES('$email')";
    if (!mysql_query($query)) {
      throw new Exception("MySQL Error: " . mysql_error());
    }
    return true;
  }

  public function add_comment($nick, $email, $www, $comment) {
    connect();
    $nick = mysql_real_escape_string(strip_tags($nick));
    $email = mysql_real_escape_string(strip_tags($email));
    if (preg_match("/http:\/\/.*\..*/", $www)) {
      $www = mysql_real_escape_string(strip_tags($www));
    } else {
      $www = '';
    }
    $comment = strip_tags($comment);
    $comment = mysql_real_escape_string($comment);

    $ip = $_SERVER['REMOTE_ADDR'];

    $hash = md5($email);
    $fname = "avatars/$hash.png";
    if (!file_exists($fname)) {
      $data = file_get_contents('http://www.gravatar.com/avatar/' . $hash . '?d=404&s=48');
      if ($data) {
        $file = fopen($fname, "w");
        if (!$file) {
          throw new Exception("IO Error: Can't open file avatars/$hash.png");
        }
        fwrite($file, $data);
        fclose($file);
      } else {
        $fname = "avatars/default.png";
      }
    }
    $query = "INSERT INTO jq_comments VALUES (now(), '$nick', '$email', '$www',
              '$comment', INET_ATON('$ip'), '$fname')";
    if (!mysql_query($query)) {
      throw new Exception("MySQL Error: " . mysql_error());
    }
    return $fname;
  }

  public function fix_avatars() {
    connect();
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
      if (!mysql_query("UPDATE jq_comments set avatar = '$avatar' where email = '$email'")) {
        throw new Exception("Can't update ${row[1]}");
      }
    }
    return $avatars;
  }

  public function get_comments() {
    connect();
    $query = "SELECT DATE_FORMAT(date, '%d-%m-%Y'), nick, avatar, www,
              comment from jq_comments order by date";
    return mysql_array($query);
  }


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

  //can't use echo
  public function _echo($ignore, $str) {
    return $str;
  }
  public function ping($ignore) {
    return "pong";
  }

}

handle_json_rpc(new Service());

?>
