<?php include('dataSending2Processing.php'); 
$runprocessing = new dataSending2Processing(); //constructor initializes a connection and sets mysqli creds to vars that will be used in the method in this class
$runprocessing->getReadyFMAPData();
?>
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
		<td>
			<img src="images/FMAP2Semcat-UI_02.jpg" width="561" height="60" alt=""></td>
		<td rowspan="2">
			<img src="images/FMAP2Semcat-UI_03.jpg" width="7" height="603" alt=""></td>
	</tr>
	<tr>
		<td align="left" valign="top" bgcolor="#FFFFFF"><img src="images/FMAP2Semcat-UI_04.jpg" alt="" width="151" height="543" border="0" usemap="#Map"></td>
	  <td width="561" height="543" align="left" valign="top" bgcolor="#FFFFFF"><br /><div style="background-color:#090; border:solid; color: #FFF;"> 
		  <h3 align="center">Below are the records that have NOT been Processed. Please click on TRANSFER to transfer the quote information into Semcat.</h3></div>
          		<div style="width:100%;">
<table>
<tr>
<th width="113">
Name
</th>
<th width="319">
Address
</th>
<th width="113">
Status
</th>
</tr>
<tr>
<td>
<?php  echo $firstname.' '.$lastname; ?>

</td>
<td>
<?php  echo $fullAddress; ?>
</td>
<td>
<?php 
//Begin Form 
?>
<form id="transfer" name="transfer" method="post" action="processing.php">
  <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" id="hiddenField" />
  <input type="hidden" name="middle" value="<?php echo @$middle; ?>" id="hiddenField" />
  <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" id="hiddenField" />
  <input type="hidden" name="suffix" value="<?php echo @$suffix; ?>" id="hiddenField" />
  <input type="hidden" name="email" value="<?php echo @$emailAddress; ?>" id="hiddenField" />
  <input type="hidden" name="houseNumber" value="<?php echo $houseNumber; ?>" id="hiddenField" />
  <input type="hidden" name="streetName" value="<?php echo $streetname; ?>" id="hiddenField" />
  <input type="hidden" name="city" value="<?php echo $city; ?>" id="hiddenField" />
  <input type="hidden" name="zip" value="<?php echo $zip; ?>" id="hiddenField" />
  <input type="hidden" name="builtMonth" value="<?php echo '6';?>" id="hiddenField" />
  <input type="hidden" name="builtYear" value="<?php echo $yearbuilt ?>" id="hiddenField" />
  
  <input type="hidden" name="dwellingUse" value="<?php echo $homeuse;?>" id="hiddenField" />
  <input type="hidden" name="occupiedBy" value="<?php echo $occupancy; ?>" id="hiddenField" />
  <input type="hidden" name="constructionType" value="<?php echo $constructiontype; ?>" id="hiddenField" />
  <input type="hidden" name="propertyType" value="<?php echo $propertytype; ?>" id="hiddenField" />
  <input type="hidden" name="sqFootage" value="<?php echo $sqfootage;?>" id="hiddenField" />
  <input type="hidden" name="desiredCoverage" value="<?php  echo $desiredcoverage;?>" id="hiddenField" />
  <input type="hidden" name="needbyMonth" value="<?php echo $needbyMonth;?>" id="hiddenField" />
  <input type="hidden" name="needbyDay" value="<?php echo $needbyDay;?>" id="hiddenField" />
  <input type="hidden" name="needbyYear" value="<?php echo $needbyYear;?>" id="hiddenField" />
  <input type="hidden" name="propertyid" value="<?php echo $propertyid;?>" id="hiddenField" />
<div style="font-size:12px; font-style:italic; color:#F00;">
<?php echo 'Need By: '.$needbyMonth.' '.$needbyDay .' '.$needbyYear.'<br />'; ?>
</div>
<input type="image" name="submit" id="submit" src="images/transferButton.jpg" />
</td>
</tr>
</table>
</div>
          </td>
	</tr>
</table>
<br /> <br />
<!-- End Save for Web Slices -->

<map name="Map">
  <area shape="rect" coords="30,17,122,37" href="fmapUploader.php">
  <area shape="rect" coords="11,50,147,77" href="unprocessed.php">
  <area shape="rect" coords="12,90,144,109" href="#">
  <area shape="rect" coords="11,123,142,143" href="#">
</map>
</body>
</html>