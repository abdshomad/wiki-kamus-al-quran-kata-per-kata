
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body onload='next()'>

<font size=4>

<?php 
$surat = $_GET['surat']; 
if($surat=='') $surat = 1;
?>

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

<?php

/*
function mb_str_split( $string ) { 
    # Split at all position not after the start: ^ 
    # and not before the end: $ 
    return preg_split('/(?<!^)(?!$)/u', $string ); 
} 
*/


// $arabic = "أ ب ت ث ج ح خ د ذ ر ز س ش ص ض ط ظ ع غ ف ق ك ل م ن ه و ي";
$arabic = "أبتثجحخدذرزسشصضطظعغفقكلمنهوي";
$corpus_quran_style = 'AbtvjHxd*rzs$SDTZEgfqklmnhwy';
$project_root_list_style = 'alif-, ba-, ta-, tha-, jiim-, ha-, kh-, dal-, thal-, ra-, zay-, siin-, shiin-, sad-, dad-, tay-, za-, ayn-, ghayn-, fa-, qaf-, kaf-, lam-, miim-, nun-, ha-, waw-, ya-'; 
$bblm_style = 'alif-, baa-, taa-, tsa-, jaa-, chaa-, khaa-, daa-, dzaa-, raa-, zaa-, saa-, shaa-, shaa-, d7aa-, thaa-, dzaa-, ain-, ghaa-, faa-, qaa-, kaa-, laa-, maa-, naa-, haa-, waa-, yaa-'; 

//$arabic_array = mb_str_split($arabic); 
$arabic_array = preg_split('//u', $arabic, -1, PREG_SPLIT_NO_EMPTY);
$corpus_quran_style_array = str_split($corpus_quran_style); 
$project_root_list_style_array = explode(", ", $project_root_list_style); 
$bblm_style_array = explode(", ", $bblm_style); 

// echo $arabic;
// echo $corpus_quran_style;

// print_r($arabic_array); 
// print_r($corpus_quran_style_array); 
//print_r($project_root_list_style_array); 
print_r($bblm_array); 
// die(); 

$sql = "SELECT * 
FROM  `quran_kata_v05` 
WHERE sura = $surat
";

$result = mysql_query($sql);

if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}

// While a row of data exists, put that row in $row as an associative array
// Note: If you're expecting just one row, no need to use a loop
// Note: If you put extract($row); inside the following loop, you'll
//       then create $userid, $fullname, and $userstatus
while ($row = mysql_fetch_assoc($result)) {
    $root1 = $row["root1"];
    $root1 = str_replace('ا', "أ", $root1); // إ
    $root1 = str_replace('إ', "أ", $root1); // ى
    $root1 = str_replace('ى', "ي", $root1); // ى
    $root2 = $row["root2"];
    $root2 = str_replace('ا', "أ", $root2); // إ
    $root2 = str_replace('إ', "أ", $root2); // ى
    $root2 = str_replace('ى', "ي", $root2); // ى
    
    $root3c_1 = str_replace($arabic_array, $bblm_style_array, $root1);
    $root3c_1 = substr($root3c_1, 0, strlen($root3c_1)-1);
    $root3c_2 = str_replace($arabic_array, $bblm_style_array, $root2);
    $root3c_2 = substr($root3c_2, 0, strlen($root3c_2)-1);
    if($root1==$root2) { $root3c = $root3c_1; } else { $root3c = $root3c_1 . ', ' . $root3c_2; }; 
    
    
    $root4_1 = str_replace($arabic_array, $corpus_quran_style_array, $root1);
    $root4_2 = str_replace($arabic_array, $corpus_quran_style_array, $root2);
    if($root1==$root2) { $root4 = $root4_1; } else { $root4 = $root4_1 . ', ' . $root4_2; }; 
    
    $root5_1 = str_replace($arabic_array, $project_root_list_style_array, $root1);
    $root5_1 = substr($root5_1, 0, strlen($root5_1)-1);
    $root5_2 = str_replace($arabic_array, $project_root_list_style_array, $root2);
    $root5_2 = substr($root5_2, 0, strlen($root5_2)-1);
    if($root1==$root2) { $root5 = $root5_1; } else { $root5 = $root5_1 . ', ' . $root5_2; }; 
    
    //$sql = "UPDATE quran_kata_v05 set root4_quran_corpus = '$root4' WHERE id = '" . $row["id"] . "'";
    $sql = "UPDATE quran_kata_v05 set root3_id_check='$root3c', root4_quran_corpus='$root4', root5_prl = '$root5' WHERE id = '" . $row["id"] . "'";
		$result1 = mysql_query($sql);
		// echo $sql;
		echo " . "; 
		if (!$result1) {
			echo "Could not successfully run query ($sql) from DB: " . mysql_error();
			exit;
		}
}

mysql_free_result($result);
echo 'Done!'; 

?> 

?>

</font>

<script lang='javascript'>
function next() {
	document.location.href ='<?php echo $_SERVER["SCRIPT_NAME"]; ?>?surat=<?php echo $surat+1 ?>'; 
}
</script>


</body>
</html>