<title>FMAP to DB</title><?php 
include('Classes/PHPExcel.php');
$username = 'testusername28';

$uploaddir = 'fmapUploads/'.$username .'/';
																   

//if($uploadfile != 'fmapUploads/'.$username.'/'){
if(!file_exists(@mkdir('fmapUploads/'. $username, 0777, true))){// or die(mysql_error());
$madeDir = 'fmapUploads/'.$username.'/';
$uploadfile = $madeDir . basename($_FILES['fmapDataFile']['name']);
}else{
echo " File already Exists";
exit;
}
//The idea here is to check to see if the same file name exists TODO: then to go on to insert it into the database and not the duplicates
if (file_exists($uploadfile)) {
	echo "The file named " . basename($uploadfile) ." already exists, rename the file";
	echo '<br/>';
	echo "There were '0' FMAP File(s) successfully uploaded.";
	exit;
} else {
	//echo "The file " . basename($uploadfile) ."  does not exist";
	//echo getcwd();
move_uploaded_file($_FILES['fmapDataFile']['tmp_name'], $uploadfile);

}

///CONNECTION
//First we need to make a connection with the database
$host='localhost'; // Host Name.
$db_user= 'laowensjr'; //User Name
$db_password= 'lo19315761';
$db= 'fmapdatarecords'; // Database Name.

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
echo "There were ". count($result) ." FMAP File(s) successfully uploaded." ;
?>