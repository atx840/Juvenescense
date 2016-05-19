<?php

if(!$_POST) exit;

$email = $_POST['email'];
$thanksPage = '../index.html'; 

//$error[] = preg_match('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $_POST['email']) ? '' : 'INVALID EMAIL ADDRESS';
if(!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" ."@"."([a-z0-9]+([\.-][a-z0-9]+)*)+"."\\.[a-z]{2,}"."$",$email )){
	$error.="Invalid email address entered";
	$errors=1;
}
if($errors==1) echo $error;
else{
	$values = array ('name','email','location','message');
	$required = array('location','email','message');
	
	if($_POST['location']=='chaparral'){
		$your_email = "chaparral@juvenescence.ca";
	} elseif ($_POST['location']=='douglasglen') {
		$your_email = "douglasglen@juvenescence.ca";
	}elseif ($_POST['location']=='jjobrien') {
		$your_email = "jjobrien@juvenescence.ca";
	}elseif ($_POST['location']=='cranston') {
		$your_email = "cranston@juvenescence.ca";
	}elseif ($_POST['location']=='monsignor') {
		$your_email = "jssmith@juvenescence.ca";
	}else {
		$your_email = "info@juvenescence.ca";
	}
	// $your_email = $_POST['location']"@gmail.com";
	// $email_subject = $_POST['location'].": ".$_POST['subject'];
	$email_subject = $_POST['subject'];
	$email_content = "\n";
	
	foreach($values as $key => $value){
	  if(in_array($value,$required)){
		if ($key != 'subject' && $key != 'location'){
		  if( empty($_POST[$value]) ) { echo 'PLEASE FILL IN All FIELDS'; exit; }
		}
		$email_content .= $value.': '.$_POST[$value]."\n";
	  }
	}
	 
	if(@mail($your_email,$email_subject,$email_content)) {
			header("Location: $thanksPage");
			exit;
	} else {
		$error_msg[] = 'Your mail could not be sent this time. ['.$points.']';

	}
}
