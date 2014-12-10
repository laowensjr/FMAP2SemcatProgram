<html>
<head>
<title>Import your FMAP Data File</title>
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
<br /> <br />
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
		<td>
			<img src="images/FMAP2Semcat-UI_04.jpg" alt="" width="151" height="543" border="0" usemap="#menubar"></td>
		<td width="561" height="543" align="left" valign="top" bgcolor="#FFFFFF"><br /><div style="background-color:#090; border:solid; color: #FFF;"> 
		  <h3 align="center">Please Choose the File that you wish to Import by Selecting the file then clicking the IMPORT button</h3></div><br /><form enctype="multipart/form-data" action="fmap2db.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
    <!-- Name of input element determines name in $_FILES array -->
    <b>Import this file:</b> 
    <input id="fmapDataFile" name="fmapDataFile" type="file" multiple/>
    <input type="submit" name="Send" value="Import" />
</form></td>
	</tr>
</table>
<!-- End Save for Web Slices -->

<map name="menubar">
  <area shape="rect" coords="26,15,133,43" href="fmapUploader.php">
  <area shape="rect" coords="10,54,142,76" href="unprocessed.php">
  <area shape="rect" coords="13,89,139,108" href="completed.php">
  <area shape="rect" coords="17,127,139,147" href="search.php">
</map>
</body>
</html>