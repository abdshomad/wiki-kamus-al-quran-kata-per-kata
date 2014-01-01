<?php

$me = 'Larry Ullman';
$scripts = array('Greek', 'Cyrillic', 'Hebrew', 'Arabic', 'Hangul');

foreach ($scripts as $script) {
    echo "$me is " . str_transliterate($me, 'Latin', $script) . " in $script.\n";
}

echo "$me is " . transliterator_transliterate ("Latin-$script", $me) . " in $script.\n";

?>