<html>
<head>
<title>FMAP2Semcat UI</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	background-color: #E9E9E9;
}
-->
</style></head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (FMAP2Semcat UI.psd) --> 
<br />
<br />
<table id="Table_01" width="719" height="603" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="images/FMAP2Semcat-UI_01.jpg" width="151" height="60" alt=""></td>
		<td align="center" valign="top">
			<img src="images/FMAP2Semcat-UI_02.jpg" width="561" height="60" alt=""></td>
		<td rowspan="2">
			<img src="images/FMAP2Semcat-UI_03.jpg" width="7" height="603" alt=""></td>
	</tr>
	<tr>
		<td>
<img src="images/FMAP2Semcat-UI_04.jpg" alt="Import your File" width="151" height="543" border="0" usemap="#Map"></td>
		<td width="561" height="543" align="left" valign="top" bgcolor="#FFFFFF"><br /><div style="background-color:#090; border:solid; color: #FFF;"> 
		  <h3 align="center">Results of Import</h3></div><br />
          <?php 
include('Classes/PHPExcel.php');
$username = 'testusername28';

$uploaddir = 'fmapUploads/'.$username .'/';
																   

//if($uploadfile != 'fmapUploads/'.$username.'/'){
if(!file_exists(@mkdir('fmapUploads/'. $username, 0777, true))){// or die(mysql_error());
$madeDir = 'fmapUploads/'.$username.'/';
$uploadfile = $madeDir . basename($_FILES['fmapDataFile']['name']);
move_uploaded_file($_FILES['fmapDataFile']['tmp_name'], $uploadfile);
}else{
echo " File already Exists";
exit;
}
//The idea here is to check to see if the same file name exists TODO: then to go on to insert it into the database and not the duplicates
if (file_exists($uploadfile)) {
	echo "The file named " . basename($uploadfile) ." already exists, rename the file";
	echo '<br/>';
	echo 'There were <b>0</b> FMAP File(s) successfully uploaded.<a href="fmapUploader.php">  Try Again</a>' ;
	exit;
} else {
	//echo "The file " . basename($uploadfile) ."  does not exist";
	//echo getcwd();
move_uploaded_file($_FILES['fmapDataFile']['tmp_name'], $uploadfile);

}

///CONNECTION
//First we need to make a connection with the database
/*$host='localhost'; // Host Name.
$db_user= 'laowensjr'; //User Name
$db_password= 'lo19315761';
$db= 'fmapdatarecords'; // Database Name.
*/
$host = "mysql7.000webhost.com";
$db = "a2300626_stone";
$db_user = "a2300626_laowens";
$db_password = "lo19315761";

$mysqli = new mysqli("$host", "$db_user", "$db_password", "$db");
/*if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}*/

//$conn=mysql_connect($host,$db_user,$db_password) or die (mysql_error());
//mysql_select_db($db) or die (mysql_error());
//END CONNECTION
///
$inputFileName = $uploadfile; /** Load $inputFileName to a PHPExcel Object **/
 $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

//$objPHPExcel = PHPExcel_IOFactory::load($path);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	$worksheetTitle     = $worksheet->getTitle();
	$highestRow         = $worksheet->getHighestRow(); // e.g. 10
	$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	//$nrColumns = ord($highestColumn) - 64;
	


// Get cell B8 $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 8)->getValue();
// iterate over spreadsheet rows and columns
// convert into INSERT query

for ($row = 3; $row <= $highestRow; ++ $row) {
$val=array();
for ($col = 0; $col < $highestColumnIndex; ++ $col) {
    $cell = $worksheet->getCellByColumnAndRow($col, $row);
    $val[] = $cell->getValue();
    
    
}//end this for

//$sql="insert into tablename (col1, col2, col3) values(`".$val[0]."`, `".$val[1]."`, `".$val[2].")";
$sql = "INSERT INTO customerinfo (customerid, contactinfo,propertyid, propertyaddress, needby, desiredcoverage, currentstatus, coverageexpiration, yearbuilt, roofupdate, electricalupdate, hvacupdate, propertytype, constructiontype, homeuse, occupancy, sqfootage, stilts, numberofclaims, poolonsite, poolenclosed, divingboard, trampoline, firehydrant, firestation, saltwaterdist, aggressivedogs, farmingonsite, uploadedby) VALUES ('".@$val[0]."', '".$val[1]."', '".$val[2]."', '".$val[3]."', '".$val[4]."', '".$val[5]."', '".$val[6]."', '".$val[7]."', '".$val[8]."', '".$val[9]."', '".$val[10]."', '".$val[11]."', '".$val[12]."', '".$val[13]."', '".$val[14]."', '".$val[15]."', '".$val[16]."', '".$val[17]."', '".$val[18]."', '".$val[19]."', '".$val[20]."', '".$val[21]."', '".$val[22]."', '".$val[23]."', '".$val[24]."', '".$val[25]."', '".$val[26]."', '".$val[27]."', '".$username."')";

if(!$result = $mysqli->query($sql)){
//if(!$result = mysql_query($sql)){
	//echo "Success $col on $row";
	//echo '<br/>';
	//This loops with the for and we output errors per column row pair
	$fmaperrors = array();
	@$fmaperrors[]=@$mysqli->error;
	echo "Successful with Notice : Check Row: $row " . @$fmaperrors[]=@$mysqli->error;
	
	echo '<br/>';
	
	
	

}//end if


}// end 1st FOR

} //1st FOREACH
echo '<br/>';

echo '<b>'; echo 'Uploaded File Name: ';
	   echo "</b>" . basename($inputFileName) . ".";
	  
echo '<br/>';
echo '<br/>';
echo 'Duplicate Entries are NOT inserted twice';
echo '<br/>';
echo 'There were '. count($result) .' FMAP File(s) successfully uploaded.<a href="fmapUploader.php">Import Another</a>' ;
echo '<br/>';
echo '<a href="unprocessed.php">Click here to Go & Process the Data you just Uploaded</a>';
?>
          
          </td>
	</tr>
</table>
<!-- End Save for Web Slices -->


<map name="Map">
  <area shape="rect" coords="29,17,124,39" href="fmapUploader.php">
  <area shape="rect" coords="9,54,145,73" href="dataSending2Processing.php">
  <area shape="rect" coords="13,90,141,108" href="#">
  <area shape="rect" coords="15,124,141,144" href="#">
</map>
</body>
</html>