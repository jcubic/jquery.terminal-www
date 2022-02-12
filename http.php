<?php
/*
 * This file is part of Simple PHP Chat
 * Released under MIT License
 *
 * https://github.com/jcubic/chat/tree/notifications
 *
 * Copyright (c) 2019 Jakub T. Jankiewicz
 */

// taken from Leash (https://leash.jcubic.pl/)
function curl($url) {
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
function get($url) {
    if (is_curl_enabled()) {
        $curl = curl($url);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    } else {
        return @file_get_contents($url);
    }
}

// ------------------------------------------------------------------------
function post($url, $data, $headers = array("Content-type: text/plain")) {
    $ch = curl($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($code != 200) {
        throw new Exception("URL: $url give error $code");
    }
    curl_close($ch);
    return $result;
}