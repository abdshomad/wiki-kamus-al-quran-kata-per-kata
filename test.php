<?php
header('Content-Type: text/html; charset=UTF-8');
if ($handle = opendir(realpath(dirname(__FILE__)).'/var/pages/')) {
    while (false !== ($file = readdir($handle))) {
        // $file = mb_substr($file, mb_strrpos($file, '/') + 1);
        if ($file != "." && $file != "..") {
            echo $file . "<br />\n";
        }
    }
    closedir($handle);
}
?>