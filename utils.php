<?php

function pretty_xml($string) {
  $xml = DOMDocument::loadXML($string);
  $xml->formatOutput = true; 
  return $xml->saveXML();
}

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
  $db_info = json_decode(file_get_contents("config.json"));
  $conn = mysql_connect($db_info->host, $db_info->user, $db_info->pass);
  mysql_select_db($db_info->db);
  return $conn;
}

// ----------------------------------------------------------------------------
// return array from mysql query
function mysql_array($query) {
  if ($res = mysql_query($query)) {
    if (mysql_num_rows($res) > 0) {
        while ($row = mysql_fetch_row($res)) {
            $result[] = $row;
        }
        return $result;
    } else {
        return array();
    }
  } else {
    throw new Exception("MySQL Error: " . mysql_error());
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
?>
