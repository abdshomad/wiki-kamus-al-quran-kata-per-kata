<?php
set_time_limit (9999999); 
echo '<pre>';
// $dir = 'D:/dropbox/Quran/Quran Image/Juzuk 06/';
$dir = 'D:/Quran/Quran Images from Ayat Software/'; // D:\Quran\Quran Images from Ayat Software
echo $dir; 
$dir_dest = 'D:/Quran/Quran Images from Ayat Software 2pages/'; // D:\Quran\Quran Images from Ayat Software
echo $dir_dest;
for($i=1; $i< (303 - 300); $i++){
  // $dir_juzuk = $dir . 'Juzuk ' . str_pad($i, 2, "0", STR_PAD_LEFT);  
  // echo $dir_juzuk . "\n<br>"; 
  // $d = dir($dir);
  $filename_left = $i . '.png';
  $filename_right = ($i + 1) . '.png'; 
  $filename_dest = str_pad($i, 3, "0", STR_PAD_LEFT) . '-' . str_pad($i+1, 3, "0", STR_PAD_LEFT) . '.png'; 
  
  echo "filename_left 1 = $filename_left"; 
  echo "filename_right 2 = $filename_right"; 
  echo "filename_dest 3 = $filename_dest"; 

      $im_src_left = imagecreatefrompng($dir . $filename_left);
      if (! $im_src_left ) { echo "failed!"; } 
      echo "succecss 1"; 
      $im_src_right = @imagecreatefrompng($dir . $filename_right) or die('die im_src_right');
      echo "succecss 2"; 
      
      $im_dest = @imagecreatetruecolor(456*2, 672*2) or die('die die'); 

      // imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )

      imagecopy($im_dest, $im_src_left, 0, 0, 0, 0, 456, 672);
      imagecopy($im_dest, $im_src_right, 0, 0, 456, 0, 456, 672);

      // Save the image as 'simpletext.jpg'
      // @mkdir(str_replace('Quran Image', 'Quran Image Per Page', $dir_juzuk));
      $success = imagepng($im_left, $dir_dest . $filename_dest);

      // Free up memory
      imagedestroy($im_dest);
      imagedestroy($im_src_left);
      imagedestroy($im_src_right);

   }
   
  $d->close();

echo '</pre>';

?> 
