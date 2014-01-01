<?php
set_time_limit (9999999); 
echo '<pre>';
$dir = 'D:/dropbox/Platform Buku Cerita Interaktif - Ref/References/Contoh Content/Aku Tidak Takut Hantu/'; // D:\Quran\Quran Images 
$d = dir($dir);
echo "Handle: " . $d->handle . "\n";
echo "Path: " . $d->path . "\n";
while (false !== ($entry = $d->read())) {
   echo $entry."\n";
}
$d->close();

echo '</pre>';

?> 
