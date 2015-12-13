<?php

require('utils.php');
/*

CREATE FUNCTION rss_date(date datetime)
RETURNS VARCHAR(30) DETERMINISTIC
RETURN DATE_FORMAT(date, "%a, %d %b %T UTC");

*/


// ----------------------------------------------------------------------------
function feed($title, $link, $description) {
  connect();
  $feed = '<?xml version="1.0"?>';
  $feed .= '<rss version="2.0">';
  $feed .= '<channel>';
  $feed .= "<title>$title</title>";
  $feed .= "<link>$link</link>";
  $feed .= "<image>";
  $feed .= "<url>http://terminal.jcubic.pl/css/images/logo.png</url>";
  $feed .= "<title>$title</title>";
  $feed .= "<link>http://terminal.jcubic.pl/#comments</link>";
  $feed .= "</image>";
  $feed .= "<copyright>Jakub Jankiewicz</copyright>";
  $feed .= "<generator>php script</generator>";
  $feed .= "<webMaster>jcubic@onet.pl</webMaster>";
  
  $query = "SELECT rss_date(date), nick, email, www, comment FROM jq_comments order by date DESC";
  
  $comments = mysql_array($query);
  $feed .= "<pubDate>{$comments[0][0]}</pubDate>";
  $feed .= "<description>$description</description>";
  foreach ($comments as $item) {
    if (!preg_match('/http:\/\//', $item[3])) {
      if (preg_match('/.*\..*/', $item[3])) {
        $url = "http://" . $item[3];
      } else {
        $url = null;
      }
    } else {
      $url = $item[3];
    }
	$item[4] = htmlspecialchars($item[4]);
    $nick = strcmp($item[1], '') == 0 ? 'Anonymous' : $item[1];
    $feed .= item($nick, $nick, $url, $item[4], $item[0]);
  }
  
  $feed .= "</channel>";
  $feed .= "</rss>";
  return $feed;
}

// ----------------------------------------------------------------------------
function item($title, $email, $link, $description, $date) {
  $item = "<item>";
  $item .= "<author>$email</author>";
  $item .= "<title>$title</title>";
  if ($link) {
    $item .= "<link>$link</link>";
  }
  $item .= "<description>$description</description>";
  $item .= "<pubDate>$date</pubDate>";
  $item .= "</item>";
  return $item;
}

try {
  $description = "Comments left by users.";
  $url = "http://terminal.jcubic.pl/comments-rss.php";
  $feed = feed("JQuery Terminal Comments", $url, $description);
  header('Content-Type: application/rss+xml');
  //echo pretty_xml($feed);
  echo $feed;
} catch (Exception $e) {
  header("HTTP/1.1 500 Internal Server Error");
  echo "Server Error: " . $e->getMessage();
  exit(1);
}

?>