<?php 
set_time_limit(999999); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<pret>
<?php
$handle = @fopen("./source-files/quran-simple-clean.txt", "r");
$sura_number = '1'; $sura_number_old = '1'; 
$line_number = 1; 
$stop_line = 900000; 
echo "Processing: "; 
$dir = './quran-simple-clean-extract-all-worlds-RESULT/'; 
@mkdir($dir); 
if ($handle) {
	$sura_content = ''; 
    while (!feof($handle) && ($line_number < $stop_line)) {
		$line_number = $line_number + 1; 
        $buffer = fgets($handle, 4096);
		$buffer_array1 = explode('|', $buffer);
		$buffer_array2 = explode(' ', $buffer_array1[2]);
		foreach($buffer_array2 as $word) {
			$word1 = trim($word);
			// echo $word1 . ' '; 
			file_put_contents($dir . $word1 . '.txt', $word1); 
		}
    } 
	echo "Done!"; 
}
?> 
</pret>
</body>