<?php
set_time_limit (9999999); 
// $dir = 'D:/dropbox/Quran/Quran Image/Juzuk 06/';
$dir = 'D:/dropbox/Quran/Quran Image/';
$dir_dest = 'D:/dropbox/Quran/Quran Image Per Page/';
for($i=1; $i<31; $i++){
  $dir_juzuk = $dir . 'Juzuk ' . str_pad($i, 2, "0", STR_PAD_LEFT);  
  echo $dir_juzuk . "\n<br>"; 
  $d = dir($dir_juzuk);
  while (false !== ($entry = $d->read())) {
   //if(trim($enty) != '.') {
   echo("entry = " . $entry . "\n<br>"); 
   echo(strlen($entry) . "\n<br>"); 
   if(strlen($entry) > 3) {
     echo $dir_juzuk . '/' . $entry."\n<br>";
      // $filename = $dir . '004-AnNisa(171-AlMaidah002).jpg'; 
      $filename = $dir_juzuk . '/' . $entry; 
      $size = getimagesize($filename);
      $width = $size[0]; 
      $height = $size[1]; 
      if($width > 1000) {

      print_r($size);
      // exit; 

      $im_src = @imagecreatefromjpeg($filename);
      $im_left = @imagecreatetruecolor(1024/2, 768) or die('matek'); 
      $im_right = @imagecreatetruecolor(1024/2, 768) or die('matek'); 

      // imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )

      imagecopy($im_left, $im_src, 0, 0, 0, 0, 1024/2, 768);
      imagecopy($im_right, $im_src, 0, 0, 1024/2, 0, 1024/2, 768);

      // Create a blank image and add some text
      //$im = imagecreatetruecolor(120, 20);
      //$text_color = imagecolorallocate($im, 233, 14, 91);
      //imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);

      // Save the image as 'simpletext.jpg'
      @mkdir(str_replace('Quran Image', 'Quran Image Per Page', $dir_juzuk));
      $success = imagejpeg($im_left, str_replace('Quran Image', 'Quran Image Per Page', str_replace('.jpg', '-left.jpg', $filename)));
      $success = imagejpeg($im_right, str_replace('Quran Image', 'Quran Image Per Page', str_replace('.jpg', '-right.jpg', $filename)));

      // Free up memory
      imagedestroy($im_left);
      imagedestroy($im_right);

   }
   }
  }
  $d->close();

}

?> 
