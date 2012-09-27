<?php 
set_time_limit(999999); 
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body onload_XXX='next()'>
<?php 
$surat = $_GET['surat']; 
if($surat=='') $surat = 1;
?>

<?php

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

$sql = "SELECT t.* 
FROM  `terjemah_kata` t
WHERE t.quran_simple_clean!=t.arab
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
$dir = 'D:/dropbox/projects/kamus-al-quran/kamus-al-quran.local/var/pages/';
$i = 0; 
while ($row = mysql_fetch_assoc($result)) {
    // $content = $row["arab_harokat"] . ' = ' . $row['indonesia'];
	$i = $i + 1; 
	$oldname = $dir . $row['arab'] . '.txt'; 
	$newname = $dir . $row['quran_simple_clean'] . '.txt'; 
	if ( file_exists($oldname) && !file_exists($newname))  {
		echo $i . ": Renaming " . $oldname . " to " . $newname . "<br>\n"; 
		$content = file_get_contents($oldname); 
		$content = str_replace($row['arab'] . ' = ', $row['quran_simple_clean'] . ' = ', $content); 
		file_put_contents($oldname, $content); 
		@rename($oldname, $newname); 
	}
}

mysql_free_result($result);
echo 'Done!'; 

?> 
</body>

<script lang='javascript'>
function next() {
	document.location.href ='<?php echo $_SERVER["SCRIPT_NAME"]; ?>?surat=<?php echo $surat+1 ?>'; 
}
</script>

</html>
