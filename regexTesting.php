<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

//If data exists with Email Address it gets it otherwise if data exists without Email Address it gets it too

  # URL that generated this code:
  # http://txt2re.com/index-php.php3?s=EDMOND%20%20MASHAMESH%20Home:%20(847)%20420-9481%20Cell:%20%3Cnone%3E%20Email:%20emashamesh@bellsouth.net&12&8&26&25&14&1

//Gets firstname, lastname, email, and phone number
/*Data for Testing contactinfo
$contactinfo='EDMOND  MASHAMESH Home: (847) 420-9481 Cell: <none> Email: emashamesh@bellsouth.net';
//$contactinfo ='Stephen  Lutsk Home: (347) 236-1077 Cell: <none> Email:';
*/
  $re1='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
  $re2='.*?';	# Non-greedy match on filler
  $re3='((?:[a-z][a-z0-9_]*))';	# Variable Name 2
  $re4='.*?';	# Non-greedy match on filler
  $re5='(\\d+)';	# Integer Number 1
  $re6='.*?';	# Non-greedy match on filler
  $re7='(\\d+)';	# Integer Number 2
  $re8='([-+]\\d+)';	# Integer Number 1
  $re9='.*?';	# Non-greedy match on filler
  $re10='([\\w-+]+(?:\\.[\\w-+]+)*@(?:[\\w-]+\\.)+[a-zA-Z]{2,7})';	# Email Address 1

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10."/is", $contactinfo, $matches))
  {
	  
      $firstname=$matches[1][0];
      $lastname=$matches[2][0];
      $areacode=$matches[3][0];
      $phone1of2=$matches[4][0];
      $phone2of2=$matches[5][0];
	  $emailAddress=$matches[6][0];
	 
	    /*To Test if Printing Out Values
      print "($firstname) ($lastname) ($areacode) ($phone1of2) ($phone2of2) ($emailAddress) \n";
	   echo '<br />';
	   $fullname = $firstname.' '.$lastname;
	   $phone = $areacode.' '.$phone1of2.''.$phone2of2;
	   echo $fullname.' '.$phone;
	  */
	  
  } elseif(!$c){
  
 $re1='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
  $re2='.*?';	# Non-greedy match on filler
  $re3='((?:[a-z][a-z0-9_]*))';	# Variable Name 2
  $re4='.*?';	# Non-greedy match on filler
  $re5='(\\d+)';	# Integer Number 1
  $re6='.*?';	# Non-greedy match on filler
  $re7='(\\d+)';	# Integer Number 2
  $re8='([-+]\\d+)';	# Integer Number 1

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8."/is", $contactinfo, $matches))
  {
      $firstname=$matches[1][0];
      $lastname=$matches[2][0];
      $areacode=$matches[3][0];
      $phone1of2=$matches[4][0];
      $phone2of2=$matches[5][0];
	    /*To Test if Printing Out Values for contactinfo column
      print "($firstname) ($lastname) ($areacode) ($phone1of2) ($phone2of2) \n";
	   echo '<br />';
	   $fullname = $firstname.' '.$lastname;
	   $phone = $areacode.' '.$phone1of2.''.phone2of2;
	   echo $fullname.' '.$phone;
	   */
  }

  }//elseif
  
  

  #-----
  # Paste the code into a new php file. Then in Unix:
  # $ php x.php 
  #-----

?>
<br />
<?php
//Gets housenumber, streetname, city, zip

/*Data for Testing propertyaddress
//$propertyaddress='9363 OLD PINE RD BOCA RATON, FL 33428-3055 PALM BEACH County';
$propertyaddress='7394 LAHANA CIR BOYNTON BEACH, FL 33437-7174 PALM BEACH County';
//$propertyaddress='334 NW TREELINE TRCEPORT SAINT LUCIE, FL 34986-2652 SAINT LUCIE County';
*/

  $re1='(\\d+)';	# Integer Number 1
  $re2='.*?';	# Non-greedy match on filler
  $re3='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
  $re4='.*?';	# Non-greedy match on filler
  $re5='((?:[a-z][a-z0-9_]*))';	# Variable Name 2
  $re6='.*?';	# Non-greedy match on filler
  $re7='((?:[a-z][a-z0-9_]*))';	# Variable Name 3
  $re8='.*?';	# Non-greedy match on filler
  $re9='((?:[a-z][a-z0-9_]*))';	# Variable Name 4
  $re10='.*?';	# Non-greedy match on filler
  $re11='((?:[a-z][a-z0-9_]*))';	# Variable Name 5
  $re12='.*?';	# Non-greedy match on filler
  $re13='(\\d+)';	# Integer Number 2
  $re14='([-+]\\d+)';	# Integer Number 1

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11.$re12.$re13.$re14."/is", $propertyaddress, $matches))
  {
      $houseNumber=$matches[1][0];
      $streetName1OF3=$matches[2][0];
      $streetName2OF3=$matches[3][0];
      $streetName3OF3=$matches[4][0];
      $city1OF2=$matches[5][0];
      $city2OF2=$matches[6][0];
      $zipcode1OF2=$matches[7][0];
      $zipcode2OF2=$matches[8][0];
      /*To Test if Printing Out Values propertyaddress column
	  print "($houseNumber) ($streetName1OF3) ($streetName2OF3) ($streetName3OF3) ($city1OF2) ($city2OF2) ($zipcode1OF2) ($zipcode2OF2) \n";
	  echo '<br />';
	  $streetname = $streetName1OF3.' '.$streetName2OF3.' '.$streetName3OF3;
	  $city = $city1OF2.' '.$city2OF2;
	  $zip = $zipcode1OF2;
	  echo $houseNumber.' '.$streetname.' '.$city.' '.$zip;
	  */
	  $streetname = $streetName1OF3.' '.$streetName2OF3.' '.$streetName3OF3;
	  $city = $city1OF2.' '.$city2OF2;
	  $zip = $zipcode1OF2;
	  $fullAddress = $houseNumber.' '.$streetname.' '.$city.' '.$zip;
	  
	  
  }

  ?>
  <br />
  <?php
  
  //Gets Need by dates
  /*Data for Testing needby
  $needby='10-01-2014';
	*/
  $re1='(\\d+)';	# Integer Number 1
  $re2='.*?';	# Non-greedy match on filler
  $re3='((?:(?:[0-2]?\\d{1})|(?:[3][01]{1})))(?![\\d])';	# Day 1
  $re4='.*?';	# Non-greedy match on filler
  $re5='((?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])';	# Year 1

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $needby, $matches))
  {
      $needbyMonth=$matches[1][0];
      $needbyDay=$matches[2][0];
      $needbyYear=$matches[3][0];
	  /*To Test if Printing Out Values for needby column
      print "($needbyMonth) ($needbyDay) ($needbyYear) \n";
	  */
  }
  ?>
  
 </body>
</html>