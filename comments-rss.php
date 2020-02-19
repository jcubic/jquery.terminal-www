<?php

require('utils.php');

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

    $query = "SELECT strftime('%s', date), nick, email, www, comment FROM jq_comments order by date DESC LIMIT 10";

    $comments = sqlite_query("comments.db", $query);
    $feed .= "<pubDate>" . date("D, d M Y H:i:s T", $comments[0]["strftime('%s', date)"]) . "</pubDate>";
    $feed .= "<description>$description</description>";
    foreach ($comments as $item) {
        if (!preg_match('/http:\/\//', $item['www'])) {
            if (preg_match('/.*\..*/', $item['www'])) {
                $url = "http://" . $item['www'];
            } else {
                $url = null;
            }
        } else {
            $url = $item['www'];
        }
        $date = date("D, d M Y H:i:s T", $item["strftime('%s', date)"]);
        $comment = htmlspecialchars($item['comment']);
        $nick = strcmp($item['nick'], '') == 0 ? 'Anonymous' : $item['nick'];
        $feed .= item($nick, $nick, $url, $comment, $date);
    }

    $feed .= "</channel>";
    $feed .= "</rss>";
    return $feed;
}

// ----------------------------------------------------------------------------
function item($title, $email, $link, $description, $date) {
    $item = "<item>";
    $item .= "<author>" . clean($email) . "</author>";
    $item .= "<title><![CDATA[" . clean($title) . "]]></title>";
    if ($link) {
        $item .= "<link>$link</link>";
    }
    $item .= "<description><![CDATA[\n" . clean($description) . "\n]]></description>";
    $item .= "<pubDate>$date</pubDate>";
    $item .= "</item>";
    return $item;
}

function clean($string) {
    return iconv("UTF-8", "UTF-8//IGNORE", $string);
}

try {
    $description = "Comments left by users.";
    $url = "http://terminal.jcubic.pl/comments-rss.php";
    $feed = feed("JQuery Terminal Comments", $url, $description);
    header('Content-Type: application/xml; charset=utf-8');
    //echo pretty_xml($feed);
    echo $feed;
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "Server Error: " . $e->getMessage();
    exit(1);
}

?>
