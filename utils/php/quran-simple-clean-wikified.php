<?php 
set_time_limit(999999); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<pre>
<?php
$handle = @fopen("quran-simple-clean.txt", "r");
$sura_number = '1'; $sura_number_old = '1'; 
$line_number = 1; 
$stop_line = 6238; 
if ($handle) {
	$sura_content = ''; 
    while (!feof($handle) && ($line_number < $stop_line)) {
		$line_number = $line_number + 1; 
        $buffer = fgets($handle, 4096);
		$buffer_array = explode('|', $buffer);
		$sura_number = $buffer_array[0]; 
		$sura_number_padded = str_pad($sura_number, 3, '0', STR_PAD_LEFT); 
        $ayah_number = $buffer_array[1]; 
		$ayah_number_padded = str_pad($ayah_number, 3, '0', STR_PAD_LEFT); 
        $ayah_content = $buffer_array[2]; 
		$ayah_content_wikified = '[' . $sura_number . ':' . $ayah_number . '] ' .
			'['. str_replace(' ', '] [', trim($ayah_content)) . ']';
		if($ayah_number == '1') {
			if($sura_number != '1') {
				$ayah_content_wikified = trim(str_replace(' [بسم] [الله] [الرحمن] [الرحيم]', '', $ayah_content_wikified)); 
			}
		}
		// echo $ayah_content_wikified; echo "\n";
		// echo "sura_number = $sura_number; sura_number_old = $sura_number_old"; 
		if($sura_number == $sura_number_old) { 
			$sura_content = $sura_content . $ayah_content_wikified . "\n"; 
		} else {
			echo 'writing file ' . $sura_number_old_padded . "\n"; 
			file_put_contents($sura_number_old_padded . '.txt', $sura_content); 
			$sura_content = $ayah_content_wikified . "\n"; 
		}
		$sura_number_old = $sura_number; 
		$sura_number_old_padded = str_pad($sura_number_old, 3, '0', STR_PAD_LEFT); 
    } 
    
    fclose($handle);
}
?> 
</pre>
</body>