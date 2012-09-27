<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<font size=10>
<?php
$dir = "./../../var/pages";
$files = scandir($dir); 
foreach($files as $entry) {
  if(preg_match("/\d/i", $entry)) {
  } else {
    $word = str_replace('.txt', '', $entry); 
    echo "<a href='./../../index.php?page=" . $word . "' target='_blank'>$word</a><br> ";
  }
}

?> 
</font>
</body>
</html>