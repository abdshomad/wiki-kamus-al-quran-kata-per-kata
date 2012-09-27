<?php 
set_time_limit(999999); 

$conn = mysql_connect("localhost", "webuser", "bismillah");
mysql_set_charset('utf8',$conn); 

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
  
if (!mysql_select_db("quran")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

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
// $dir = './quran-simple-clean-extract-all-worlds-RESULT/'; 
// @mkdir($dir); 
if ($handle) {
	$sura_content = ''; 
    while (!feof($handle) && ($line_number < $stop_line)) {
		$line_number = $line_number + 1; 
        $buffer = fgets($handle, 4096);
		$buffer_array1 = explode('|', $buffer);
		$sura = $buffer_array1[0]; $aya = $buffer_array1[1];
		$buffer_array2 = explode(' ', $buffer_array1[2]);
		$no = 0; 
		foreach($buffer_array2 as $word) {
			$no = $no + 1; 
			if ($word == '') $no = $no - 1; 
			$sql = "UPDATE terjemah_kata SET quran_simple_clean = '$word' WHERE sura = '$sura' AND aya = '$aya' AND no = '$no'";

			$result = mysql_query($sql);
			echo $word . ' '; 
			if (!$result) {
				echo "Could not successfully run query ($sql) from DB: " . mysql_error();
				exit;
			}
		}
    } //  ? 
	echo "Done!"; 
}


?> 
</pret>
</body>