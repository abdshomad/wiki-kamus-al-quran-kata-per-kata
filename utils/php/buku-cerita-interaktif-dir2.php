<?php
set_time_limit (9999999); 
echo '<pre>';
$dir = 'D:/dropbox/Platform Buku Cerita Interaktif - Ref/References/Contoh Content/Aku Tidak Takut Hantu/'; // D:\Quran\Quran Images 
$files1 = scandir($dir);
$files2 = scandir($dir, 1);

//print_r($files1);
//print_r($files2);
$left_img_arr = array();
$right_img_arr = array();

$i = 0; 
foreach($files1 as $f) {
  $i = $i + 1; 
  if($i > 2) {
  $seq = substr($f, 14, 4);
      if ( ($seq % 2) == 1) { 
        $left_img_arr[] = $f;
      } else {
        $right_img_arr[] = $f;
      }
      // echo $seq . "\n"; 
  }
}

foreach($left_img_arr as $a) {
  
}

  echo "left"; 
  print_r($left_img_arr);

  echo "right"; 
  print_r($right_img_arr);


echo '</pre>';

?> 
