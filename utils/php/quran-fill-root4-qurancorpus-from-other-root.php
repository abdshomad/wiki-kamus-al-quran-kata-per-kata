<?php 
set_time_limit(999999); 
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body onload='next()'>
<?php 
$surat = $_GET['surat']; 
if($surat=='') $surat = 1;
?>

<?php

# select k.*, q.`Data`, q.Translation from quran_kata_v03 k LEFT JOIN qeword q ON k.sura=q.SId and k.vers=q.VId and k.pos=q.WordId  WHERE k.sura between 1 and 2; 

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
