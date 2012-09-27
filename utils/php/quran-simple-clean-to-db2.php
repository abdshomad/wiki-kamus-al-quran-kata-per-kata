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
        $buffer = trim(fgets($handle, 4096));
		$buffer_array1 = explode('|', $buffer);
		$sura = $buffer_array1[0]; $aya = $buffer_array1[1];
		$content = $buffer_array1[2]; 
		//$content = str_replace('  ', ' ', $content); 
		//$content = str_replace('  ', ' ', $content); 
		$content = str_replace('  ', ' ', $content); 
		$content = str_replace(' يا ', ' يا', $content); 
		$content = str_replace('يا بن', 'يابن', $content);
		$content = str_replace('يا أي', 'ياأي', $content);
		$content = str_replace('بعدما', 'بعد ما', $content); // fix 2:181
		// beda: 2:245
		$content = str_replace('يا أهل', 'ياأهل', $content); // fix 3:65
		$content = str_replace('ها أنتم', 'هاأنتم', $content); // fix 3:66
		$content = str_replace('يا قو', 'ياقو', $content); // fix 5:71
		$content = str_replace('يا قو', 'ياقو', $content); // fix 5:71
		$content = str_replace('يا مريم', 'يامريم', $content); // fix 3:43
		$content = str_replace('يا معشر', 'يامعشر', $content); // fix 6:130
		$content = str_replace('يا آدم', 'ياآدم', $content); // fix 7:19
		$content = str_replace('سميتموهاأنتم', 'سميتموها أنتم', $content); // fix 7:71
		$content = str_replace(' ويا سماء ', ' وياسماء ', $content); // fix 11:44
		$content = str_replace('يا إبراهيم ', 'ياإبراهيم ', $content); // fix 11:76
		$content = str_replace('يا صاحبي ', 'ياصاحبي ', $content); // fix 12:39
		$content = str_replace('أتياأهل ', 'أتيا أهل ', $content); // fix 18:77
		$content = str_replace('يا زكريا', 'يازكريا', $content); // fix 19:7
		$content = str_replace('يا يحيى', 'يايحيى', $content); // fix 19:12
		$content = str_replace('يا أخت', 'ياأخت', $content); // fix 19:28
		$content = str_replace('يا أبت ', 'ياأبت ', $content); // fix 19:43
		if($sura.':'.$aya=='20:94') $content = str_replace('ابن أم', 'ابنأم', $content); // fix 20:94 < -- salah kayaknya
		$content = str_replace('يا ويلتى', 'ياويلتى', $content); // fix 25:28
		$content = str_replace('يا موسى', 'ياموسى', $content); // fix 27:9
		$content = str_replace('يا عبادي', 'ياعبادي', $content); // fix 29:56
		$content = str_replace('يا نساء', 'يانساء', $content); // fix 33:30
		$content = str_replace('يا حسرة', 'ياحسرة', $content); // fix 36:30
		$content = str_replace('يا داوود', 'ياداوود', $content); // fix 38:26
		$content = str_replace('يا عباد', 'ياعباد', $content); // fix 43:68
		$content = str_replace('يا ليتها ', 'ياليتها ', $content); // fix 69:27
		$content = str_replace('وأن لو', 'وأنلو', $content); // fix 72:16
		if($sura.':'.$aya=='71:1') $content = str_replace('إناأرسلنا', 'إنا أرسلنا', $content); // fix 71:1 < --- salah kayaknya? kita bisa check nanti 
		// $content = preg_replace(/([^ ]يا )/, 'يا', $content); 
		if ($sura . ':' . $aya == '1:1') {
			// echo 'sura 1:1 <br>'; 
		} else {
			if ( ($aya == 1) && ($sura!=9) ) {
				// echo $sura . ':' . $aya; 
				// $pos = strpos('بسم الله الرحمن الرحيم', $content); 
				$len = strlen(' بسم الله الرحمن الرحيم');
				// echo 'pos : ' . $pos; 
				// echo "<br>";
				// $content = str_replace('بسم الله الرحمن الرحيم', '', $content); 
				$content = substr($content, $len); 
				// echo $content; 
				// echo "<br>";
			}
		}
		$buffer_array2 = explode(' ', $content);
		$no = 0; 
		foreach($buffer_array2 as $word) {
			$word = trim($word);
			if ($word == '') { 
				$word = $buffer_array2[1]; 
				echo "word is blank: $sura:$aya:$no : $content <br>"; 
				print_r($buffer_array2); 
				echo "<br>";
			} 
			if ( (strpos(' ۖ ۗۘۙۚۛۜ  ', $word)) > 0) { 
				// echo ' * '; 
			} else {
				$no = $no + 1; 
				$sql = "UPDATE terjemah_kata SET quran_simple_clean = '$word' WHERE sura = '$sura' AND aya = '$aya' AND no = '$no'";

				$result = mysql_query($sql);
				// echo $word . ' '; 
				if (!$result) {
					echo "Could not successfully run query ($sql) from DB: " . mysql_error();
					exit;
				}
			}
		}
    } //  ? 
	echo "Done!"; 
}


?> 
</pret>
</body>