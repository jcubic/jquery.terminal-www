<?php
$global_conn;

function kb($size) {
    return number_format($size / 1024, "1") . "KB";
}
// -----------------------------------------------------------------------------
function curl($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    if (isset($_SERVER['HTTP_USER_AGENT']) && !preg_match("/GitHub/", $_SERVER['HTTP_USER_AGENT'])) {
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
// -----------------------------------------------------------------------------
function mkgz($source, $level = 9) {
    $dest = $source . '.gz';
    $mode = 'wb' . $level;
    $error = false;
    if ($fp_out = gzopen($dest, $mode)) {
        if ($fp_in = fopen($source,'rb')) {
            while (!feof($fp_in))
                gzwrite($fp_out, fread($fp_in, 1024 * 512));
            fclose($fp_in);
        } else {
            $error = true;
        }
        gzclose($fp_out);
    } else {
        $error = true;
    }
    if ($error) {
        return false;
    } else {
        return $dest;
    }
}
// -----------------------------------------------------------------------------
function unzip_url($url) {
    $curl = curl($url);
    $data = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $error = curl_error($curl);
    curl_close($curl);
    if ($http_code != 200) {
        throw new Exception("curl error " . $error . " error code " . $http_code);
    }
    $fname = tempnam(sys_get_temp_dir(), 'terminal_') . ".zip";
    $file = fopen($fname, 'w');
    $ret = fwrite($file, $data);
    fclose($file);
    $zip = new ZipArchive();
    $res = $zip->open($fname);
    if ($res === true) {
        if (!$zip->extractTo(sys_get_temp_dir())) {
            throw new Exception("Have problem extracting files to '$temp_dir'");
        }
        $zip->close();
    } else {
        throw new Exception("Can't open zip file");
    }
}

// -----------------------------------------------------------------------------
function version() {
    $url = 'https://api.github.com/repos/jcubic/jquery.terminal/git/refs/tags';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "PHP " . phpversion());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = json_decode(curl_exec($ch));
    curl_close($curl);
    $last = array_pop($json);
    if (isset($last->ref)) {
        return preg_replace("%refs/tags/%", "", $last->ref);
    }
    return '';
}

// -----------------------------------------------------------------------------
if (!function_exists('get_raw_post_data')) {
    // taken from json-rpc and serivce.php include both
    function get_raw_post_data() {
        if (isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
            return $GLOBALS['HTTP_RAW_POST_DATA'];
        } else {
            return file_get_contents('php://input');
        }
    }
}
// -----------------------------------------------------------------------------
function pretty_xml($string) {
    $xml = DOMDocument::loadXML($string);
    $xml->formatOutput = true;
    return $xml->saveXML();
}

// -----------------------------------------------------------------------------
function not_modified() {
    $mod_time = filemtime(__FILE__);
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mod_time) . ' GMT');

    if (isset($_SERVER['If-Modified-Since']) &&
        strtotime($_SERVER['If-Modified-Since']) < $mod_time) {
        header ("HTTP/1.0 304 Not Modified");
        header ('Content-Length: 0');
        exit(0);
    }
}
// ----------------------------------------------------------------------------
function connect() {
    global $global_conn;
    $db_info = json_decode(file_get_contents("config.json"));
    $global_conn = mysqli_connect($db_info->host, $db_info->user, $db_info->pass, $db_info->db);
    return $global_conn;
}

// ----------------------------------------------------------------------------
// return array from mysql query
function mysqli_array($query) {
    global $global_conn;
    if ($res = mysqli_query($global_conn, $query)) {
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_row($res)) {
                $result[] = $row;
            }
            return $result;
        } else {
            return array();
        }
    } else {
        throw new Exception("MySQL Error: " . mysqli_error($global_conn));
    }
}
// ----------------------------------------------------------------------------
function install() {
    connect();

    $queries = array("CREATE TABLE ip (id INTEGER NOT NULL auto_increment , adress
                     BIGINT, PRIMARY KEY(id))", "CREATE TABLE agents (id INTEGER
                     NOT NULL auto_increment, name VARCHAR(500), PRIMARY KEY(id))",
                     "CREATE TABLE hosts(id INTEGER NOT NULL auto_increment,
                     name VARCHAR(50), PRIMARY KEY(id))",
                     "CREATE TABLE pages(id INTEGER NOT NULL auto_increment,
                     name VARCHAR(256), PRIMARY KEY(id))",
                     "CREATE TABLE hits (ip_id BIGINT, page_id INTEGER NOT NULL
                     REFERENCES pages(id), host_id INTEGER NOT NULL REFERENCES
                     hosts(id), referer VARCHAR(500), agent_id INTEGER NOT NULL
                     REFERENCES agents(id), date DATETIME)");
    /*
       select ip.id, pages.id, hosts.id, referer, agents.id, created from ip, pages, hosts, tmp_hits, agents WHERE ip.id = tmp_hits.ip and
       tmp_hits.host = hosts.name and pages.name = tmp_hits.page

       insert into hits select ip.id, pages.id, hosts.id, referer, agents.id, created from ip, pages, hosts, tmp_hits, agents WHERE ip.adress = tmp_hits.ip and
       tmp_hits.host = hosts.name and pages.name = tmp_hits.page


       select count(*) from ip, pages, hosts, tmp_hits, agents WHERE ip.adress = tmp_hits.ip and tmp_hits.host = hosts.name and pages.name = tmp_hits.page

       "select ip.id, pages.id, hosts.id, referer, agents.id, created from tmp_hits LEFT JOIN (ip, pages, hosts, agents) ON (ip.adress = tmp_hits.ip and tmp_hits.host = hosts.name and pages.name = tmp_hits.page)"

       //ok
       echo "select count(*) from ip, tmp_hits, pages, agents where ip.adress = tmp_hits.ip and pages.name = tmp_hits.page and tmp_hits.agent = agents.name" | mysql --user=jcubic -pvampire666 jcubic_main

       select count(*) from ip, tmp_hits, pages, agents where ip.adress = tmp_hits.ip and pages.name = tmp_hits.page and agents.name = tmp_hits.agent

       select count(*) from tmp_hits, ip, agents where ip.adress = tmp_hits.ip and agents.name = tmp_hits.agent

       echo "CREATE TABLE agents (id INTEGER NOT NULL auto_increment, name VARCHAR(500), PRIMARY KEY(id))" | mysql --user=jcubic -pvampire666 jcubic_main
     */
    foreach ($queries as $query) {
        mysql_query($query);
    }

}



// ----------------------------------------------------------------------------
function hit() {
    connect();
    $page =  rawurldecode($_SERVER["REQUEST_URI"]);
    $agent = mysql_real_escape_string($_SERVER["HTTP_USER_AGENT"]);
    $ip = $_SERVER['REMOTE_ADDR'];
    $host = $_SERVER["HTTP_HOST"];
    $referer = isset($_SERVER["HTTP_REFERER"]) ? mysql_real_escape_string(rawurldecode($_SERVER["HTTP_REFERER"])) : "";
    $query = "INSERT INTO tmp_hits VALUES(INET_ATON('$ip'), '$page', '$host', '$referer', '$agent', now())";
    return mysql_query($query);
}

function sqlite_array($file, $query, $data = NULL) {
    return sqlite_query($file, $query, $data, false);
}

function sqlite_query($file, $query, $data = NULL, $asoc = true) {
    $db = new PDO("sqlite:$file");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($data == null) {
        $res = $db->query($query);
    } else {
        $res = $db->prepare($query);
        if ($res) {
            if (!$res->execute($data)) {
                throw Exception("execute query failed");
            }
        } else {
            throw Exception("wrong query");
        }
    }
    if ($res) {
        if (preg_match("/^\s*INSERT|UPDATE|DELETE|ALTER|CREATE|DROP/i", $query)) {
            return $res->rowCount();
        } else {
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        throw new Exception("Coudn't open file");
    }
}

function hash36($str) {
  $arr = unpack("C*", pack("L", crc32($str)));
  return implode(array_map(function($number) {
    return base_convert($number, 10, 36);
  }, $arr));
}

function hashfile($fname) {
  return hash36(file_get_contents($fname));
}

function rate_limit($ip, $limit) {
    $query = "SELECT strftime('%s', 'now') - strftime('%s', date) as time FROM jq_comments WHERE ip = ? ORDER BY
              date desc LIMIT 1";
    $arr = sqlite_array("comments.db", $query, array($ip));

    return count($arr) === 1 && $arr[0]['time'] < $limit;
}

function is_spam($string) {
    if (preg_match("/\\b[13][a-km-zA-HJ-NP-Z1-9]{25,34}\\b/", $string)) {
        return true;
    }
    if (preg_match("/\\b(BTC|bitcoin|crypto|donate|Support me)\\b/i", $string)) {
        return true;
    }
    return false;
}

function debug_log($message) {
  $fname = "debug.log";
  file_put_contents($fname, $message . "\n", FILE_APPEND);
}

