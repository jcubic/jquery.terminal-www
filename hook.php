<?php

require('utils.php');
$data = json_decode(get_raw_post_data());

/* debug code - use intead of WebHook
$data = new stdClass();
$data->ref_type = 'tag';
$data->ref = '2.44.1';
*/
if (isset($data->ref_type) && $data->ref_type == "tag") {
    $version = $data->ref;
    unzip_url("https://github.com/jcubic/jquery.terminal/archive/refs/tags/$version.zip");

    $files = array(
        "js/jquery.terminal.js",
        "js/jquery.terminal.min.js",
        "css/jquery.terminal.css",
        "css/jquery.terminal.min.css",
        "css/emoji.css",
        "js/emoji.js",
        "js/dterm.js",
        "js/prism.js",
        "js/pipe.js",
        "js/less.js",
        "js/ascii_table.js",
        "js/unix_formatting.js",
        "js/xml_formatting.js"
    );

    $path = sys_get_temp_dir() . "/jquery.terminal-$version";
    $data = array();
    foreach ($files as $file) {
        $fname = $path . "/" . $file;
        $data[$file] = array();
        $data[$file]['size'] = kb(filesize($fname));
        if (mkgz($fname)) {
            $data[$file]['gzip'] = kb(filesize($fname . ".gz"));
        }
    }
    $copy = array(
        'css/jquery.terminal.min.css',
        'js/jquery.terminal.min.js',
        'js/prism.js',
        'js/less.js',
        'js/dterm.js',
        'js/unix_formatting.js'
    );
    foreach ($copy as $file) {
        copy("$path/$file", $file);
    }
    $f = fopen($version . ".json", "w");
    fwrite($f, json_encode($data, JSON_PRETTY_PRINT));
    fclose($f);
    $f = fopen("version", "w");
    fwrite($f, $version);
    fclose($f);
}
