<?php 
include('apiKey.php');
/*
 *  **********************************************************************************************************************
 * Developer & Doc Author: Lawrence Owens
 * Name of Application: Blank2Semcat
 * 
 * Summary: 
 * First we will setup the incoming FMAP customer data, $apikey and $authenticity_token, additionally we'll setup the URLs 
 * for the forms that we will be accessing along with the POSTFIELDS associated with each URL.
 * Secondly, this Application will post to multiple forms on the same server. They will not post in parallel. 
 * 	They will make multiple serial request using the same cURL handle.
 * 
 * cURL Resources - See Resources: 
 * 	1) Multiple Actions with cURL - http://stackoverflow.com/questions/9549892/multiple-actions-with-curl
 * 	2) cURL Posting to Multiple Forms on Another Server - 
 * 		http://forums.devshed.com/php-development-5/curl-posting-multiple-forms-server-314318.html
 * 	3) Set an Option for a cURL Transfer - http://php.net/manual/en/function.curl-setopt.php
 * **********************************************************************************************************************
 */
 
/*
 * ***********************************************
 * Sets the APIKEY AND AUTHENTICITY TOKEN
 * ***********************************************
 */ //$k stands for key. Instantiating apiKey class will allow us to set the variables apikey and authenticity_token
$k = new apiKey();
$apikey = $k->getApiKey();
$authenticity_token = $k->getAuthenticityToken();
//  END SETTING APIKEY AND AUTHENTICTY TOKEN

/*
 * ***************************************************************************************************************************************
* 				Setting the user data within the variables that we'll use within the POSTFIELDS Data Links
*
* Setting the Data sent from the FMAP2Semcat Program available and ready to be inserted.The Data inserted here will essentially build the
* 	POSTFIELD(cURL option POSTFIELDS) data links needed to autofill  the 5 forms.
* ***************************************************************************************************************************************

*/ //BEGIN SETTING USER DATA

define("INSTATE", "FL"); // FL is a constant named INSTATE

if(isset($_POST['firstname'])){
	$firstname		=   	urlencode($_POST['firstname']);}
		else $firstname = "Joe";

@$middle 		= 		$_POST['middle'];

if(isset($_POST['lastname'])){
	$lastname		=   	urlencode($_POST['lastname']);}
		else $lastname  = "Doe";

@$suffix 		= 		$_POST['suffix'];

if(isset($_POST['email'])){
	$email		=   	urlencode($_POST['email']);}
	else{ 
			$email1  = "BlankEmail@email.com";
			$email = urlencode($email1);
					}
	
$state 			= 		INSTATE;

if(isset($_POST['houseNumber'])){
	$houseNumber		=   	urlencode($_POST['houseNumber']);}
		else $houseNumber  = "1234";

if(isset($_POST['streetName'])){
	$streetName		=   	urlencode($_POST['streetName']);}
		else $streetName = "BlankStreet";	

if(isset($_POST['city'])){
	$city		=   	urlencode($_POST['city']);}
		else{
				$city1 = "Winter Park";
				$city  = urlencode($city1);
					}

if(isset($_POST['zip'])){
	$zip		=   	$_POST['zip'];}
	else $zip  = "32792";

if(isset($_POST['builtMonth'])){
	$builtMonth		=   	$_POST['builtMonth'];}
	else $builtMonth  = "6";
	
if(isset($_POST['builtYear'])){
	$builtYear		=   	$_POST['builtYear'];}
	else $builtYear  = "2007";
	
if(isset($_POST['dwellingUse']) && $_POST['dwellingUse'] == 'Primary Residence'){
	//$dwellingUse		=   	$_POST['dwellingUse'];}
	$dwellingUse		=   	"Primary";}
	else $dwellingUse  = "Secondary";
		
if(isset($_POST['occupiedBy']) && $_POST['occupiedBy'] == 'Owner'){
	//$occupiedBy		=   	$_POST['occupiedBy'];}
	$occupiedBy		=   	"Owner";}
	else $occupiedBy  = "Renter";
	
if(isset($_POST['constructionType'])){
	$constructionType		=   	$_POST['constructionType'];}
	else $constructionType  = "Masonry";
	
if(isset($_POST['propertyType']) && $_POST['propertyType'] == 'house'){
	//$propertyType		=   	$_POST['propertyType'];}
	$propertyType		=   	"Dwelling";}
	else {$propertyType  = "Town House";
	$propertyType = urlencode($propertyType);}

if(isset($_POST['sqFootage'])){
	$sqFootage		=   	$_POST['sqFootage'];}
	else $sqFootage  = "2300";

$fireHydrantDistance = "10";

if(isset($_POST['desiredCoverage'])){
	$desiredCoverage		=   	$_POST['desiredCoverage'];}
	else $desiredCoverage  = "250000";

if(isset($_POST['needbyMonth'])){
	$needbyMonth		=   	$_POST['needbyMonth'];}
	else $needbyMonth  = "12";

if(isset($_POST['needbyDay'])){
	$needbyDay		=   	$_POST['needbyDay'];}
	else $needbyDay  = "12";

if(isset($_POST['needbyYear'])){
	$needbyYear		=   	$_POST['needbyYear'];}
	else $needbyYear  = "2015";


//END SETTING USER DATA


/************************************************************************************************************************
 * 			Setting the URLs & RefererUrls within the variables that we'll use with cURL option CURLOPT_URL
 * 
 * There are 5 Sections of Forms we need to complete, 2 of which require no fill in. One(1), the confirmUrl, requires we
 * 	confirm accuracy of the 5 forms we are completing and ultimately press submit to send it to Semcat. 
 *  	
 * While the finishUrl is the confirmation page of a successful submit of all 5 forms and is the only page we will show
 * 	to the operator in a pop up window. Each form section has a Url and RefererUrl in which we set the values for in its
 * 	variable.
 * They are as Follows: $startUrl, $applicantUrl, $coApplicantUrl, $addressUrl, $policyUrl, $confirmUrl, $finishUrl
 *  An "R" is appended to the end of the URL to distinquish it as the RefererUrl - example $startUrlR 
 *   The finishUrl does not have a REFERER.
 ************************************************************************************************************************

 */ // BEGIN URLs and REFERERS VARIABLES
$startUrl = "https://entryform.semcat.net/1800stonewall";
$startUrlR = "https://entryform.semcat.net/1800stonewall/";

$applicantUrl = "https://entryform.semcat.net/1800stonewall/personal/applicant";
$applicantUrlR = "https://entryform.semcat.net/1800stonewall/personal/applicant?api_key=$apikey";

$coApplicantUrl = "https://entryform.semcat.net/1800stonewall/personal/to_dwelling?api_key=$apikey";
$coApplicantUrlR = "https://entryform.semcat.net/1800stonewall/personal/coapplicant?api_key=$apikey";

$addressUrl ="https://entryform.semcat.net/1800stonewall/personal/dwelling";
$addressUrlR = "https://entryform.semcat.net/1800stonewall/personal/dwelling?api_key=$apikey";

$policyUrl = "https://entryform.semcat.net/1800stonewall/personal/policies";
$policyUrlR = "https://entryform.semcat.net/1800stonewall/personal/policies?api_key=$apikey";

$confirmUrl = "https://entryform.semcat.net/1800stonewall/personal/confirm?api_key=$apikey";
$confirmUrlR = "https://entryform.semcat.net/1800stonewall/personal/confirm?api_key=$apikey";

$finishUrl = "https://entryform.semcat.net/1800stonewall/personal/finish?api_key=$apikey";
//   END URLs and REFERERS VARIABLES

/*
 * *************************************************************************************************************************
 * 					Setting the Data within the variables that we'll use for cURL option POSTFIELDS
 * 
 * There are 5 Sections of Forms that need to be completed. Each form has its own URL, in which we set above, but it each 
 * 	form also has its own post fields that need to be completed. Each form also contains a submit button which after 
 * 	completing the form's fields it needs to be pressed in order to move to the next form section. Here is where will will 
 * 	set the data used in the POSTFIELDS option for each form. 
 * 
 * Appended with a "D" for Data the the variables are as follows:
 *  $startUrlD, $applicantUrlD, $coApplicantUrlD, $addressUrlD, $policyUrlD, $confirmUrlD
 * *************************************************************************************************************************
 
 */ //	BEGIN POSTFIELDS DATA	
$startUrlD = "utf8=%E2%9C%93&authenticity_token=$authenticity_token&person%5Bgiven_name%5D=$firstname&person%5Bmiddle_name%5D=$middle&person%5Blast_name%5D=$lastname&person%5Bsuffix%5D=$suffix&lead%5Bemail%5D=$email&lead%5Bhome%5D=0&lead%5Bhome%5D=1&lead%5Bauto%5D=0&lead%5Blife%5D=0&lead%5Bhealth%5D=0&lead%5Bfarm%5D=0&lead%5Bboat%5D=0&lead%5Brv%5D=0&lead%5Bmotorcycle%5D=0&lead%5Bplu%5D=0&lead%5Bdisability%5D=0&agent_uid=&api_key=$apikey&from=fmap2semcat&commit=Get+quote";
$applicantUrlD = "utf8=%E2%9C%93&authenticity_token=$authenticity_token&person%5Bgender%5D=&person%5Bresidence_state%5D=FL&person%5Bcounty_id%5D=&person%5Bbirth_dt_month%5D=&person%5Bbirth_dt_day%5D=&person%5Bbirth_dt_year%5D=&lead%5Bphone%5D=&nextpage=default&api_key=$apikey&commit=Next";
$coApplicantUrlD = "authenticity_token=$authenticity_token";
$addressUrlD = "utf8=%E2%9C%93&authenticity_token=$authenticity_token&lead%5Baddress_house_number%5D=$houseNumber&lead%5Baddress_street_name%5D=$streetName&lead%5Baddress_unit_number%5D=&lead%5Baddress_city%5D=$city&lead%5Baddress_state%5D=FL&lead%5Baddress_postal_code%5D=$zip&dwelling%5Bbuilt_dt_month%5D=$builtMonth&dwelling%5Bbuilt_dt_year%5D=$builtYear&dwelling%5Bpurchase_dt_month%5D=&dwelling%5Bpurchase_dt_year%5D=&dwelling%5Buse%5D=$dwellingUse&dwelling%5Bconstruction_type%5D=$constructionType&dwelling%5Boccupied_by%5D=$occupiedBy&dwelling%5Bstructure_type%5D=$propertyType&dwelling%5Bnum_stories%5D=&dwelling%5Btotal_sq_ft%5D=$sqFootage&dwelling%5Bfire_hydrant_distance%5D=$fireHydrantDistance&dwelling%5Bcov%5D=$desiredCoverage&nextpage=default&api_key=$apikey&commit=Next";
$policyUrlD = "utf8=%E2%9C%93&authenticity_token=$authenticity_token&lead%5Bhome_contract_effective_dt_month%5D=$needbyMonth&lead%5Bhome_contract_effective_dt_day%5D=$needbyDay&lead%5Bhome_contract_effective_dt_year%5D=$needbyYear&lead%5Bhome_prior_carrier%5D=&lead%5Bprior_home_payment%5D=%24&lead%5Byears_loss_free%5D=&nextpage=default&api_key=$apikey&commit=Next";
$confirmUrlD = "utf8=%E2%9C%93&authenticity_token=$authenticity_token&lead%5Bcomments%5D=&api_key=$apikey&commit=Confirm+that+you%27re+done";
// 		END POSTFIELDS DATA
 
// Initialize cURL Handle as $ch variable. We will continue to use this handle($ch) for all the connections until the 5 forms 
//	have all processed
$ch = curl_init(); 

// BEGIN START FORM COMPLETION
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:32.0) Gecko/20100101 Firefox/32.0" );
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
curl_setopt($ch, CURLOPT_URL, "$startUrl"); // start Url
curl_setopt($ch, CURLOPT_REFERER, "$startUrlR"); // start Referer
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$startUrlD"); //start Url Data
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
curl_setopt ($ch, CURLOPT_CAINFO, 'c:\wamp\www\fmap2semcat\1800stonewall\cacert.pem');
// END START FORM COMPLETION

if($res = curl_exec($ch)){
	echo "<b>";
	echo "FMAP2Semcat has successfully transferred this FMAP Customer Info to Semcat in order to process the home insurance quote.";
	echo "<br/>";
	echo "The following is the Confirmation page that was sent back to this FMAP2Semcat Program from Semcat";
	echo "</b>";
				} 
	else { echo "<b>"; 
	echo "The system has encountered an error. Please contact the Developer: Lawrence Owens(laowensjr@gmail.com)";
	echo "</b>";
	} 
	if($error = curl_error($ch)){	
		echo 'ERROR: ',$error;}
	// EXECUTE START FORM COMPLETION


// BEGIN APPLICANT FORM COMPLETION
curl_setopt($ch, CURLOPT_URL, "$applicantUrl");
curl_setopt($ch, CURLOPT_REFERER, "$applicantUrlR"); // applicant Referer
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$applicantUrlD"); // applicant Data
// END APPLICANT FORM COMPLETION

$res = curl_exec($ch); // EXECUTE APPLICANT FORM COMPLETION
// TODO: check $res FOR SUCCESS

//BEGIN CO-APPLICANT FORM COMPLETION
curl_setopt($ch, CURLOPT_URL, "$coApplicantUrl");
curl_setopt($ch, CURLOPT_REFERER, "$coApplicantUrlR"); // coApplicant Referer
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$coApplicantUrlD"); // coApplicant Data
//END CO-APPLICANT FORM COMPLETION

$res = curl_exec($ch); // EXECUTE CO-APPLICANT FORM COMPLETION
// TODO: check $res FOR SUCCESS

//BEGIN ADDRESS FORM COMPLETION
curl_setopt($ch, CURLOPT_URL, "$addressUrl");
curl_setopt($ch, CURLOPT_REFERER, "$addressUrlR"); // address Referer
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$addressUrlD"); // address Data
//END ADDRESS FORM COMPLETION

$res = curl_exec($ch); // EXECUTE ADDRESS FORM COMPLETION
// TODO: check $res FOR SUCCESS

//BEGIN POLICY FORM COMPLETION
curl_setopt($ch, CURLOPT_URL, "$policyUrl");
curl_setopt($ch, CURLOPT_REFERER, "$policyUrlR"); // policy Referer
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$policyUrlD"); // policy Data
//END POLICY FORM COMPLETION

$res = curl_exec($ch); // EXECUTE POLICY FORM COMPLETION
// TODO: check $res FOR SUCCESS

//BEGIN CONFIRM FORM COMPLETION
curl_setopt($ch, CURLOPT_URL, "$confirmUrl");
curl_setopt($ch, CURLOPT_REFERER, "$confirmUrlR"); // confirm Referer
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$confirmUrlD"); // confirm Data
//END CONFIRM FORM COMPLETION

echo $res = curl_exec($ch); // EXECUTE CONFIRM FORM COMPLETION
// TODO: check $res FOR SUCCESS

//Put last URL into string so we can send it to DB
$lastUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);



curl_close($ch);

?>