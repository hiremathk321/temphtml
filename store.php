<?php

if(isset($_POST['submit'])) {



    // EDIT A LINE BELOW AS REQUIRED

    $email_to = "jobs@jobsheight.in";

    // Custome your email subject

    $email_subject = "Resume recieved";





    function died($error) {

        // your error code can go here

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";

        echo "These errors appear below.<br /><br />";

        echo $error."<br /><br />";

        echo "Please go back and fix these errors.<br /><br />";

        die();

    }



    // validation expected data exists

    if(!isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
		!isset($_POST['email']) ||
		!isset($_POST['number']) ||
		!isset($_POST['baby']) ||
		!isset($_POST['cctc']) ||
		!isset($_POST['ectc']) ||
        !isset($_POST['city'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


   $fname = test_input($_POST['fname']);// required
   $lname = test_input($_POST['lname']);// required
   $email= test_input($_POST['email']);// required
   $number = test_input($_POST['number']);// required
   $baby = test_input($_POST['baby']);// required
   $cctc = test_input($_POST['cctc']);// required
   $ectc = test_input($_POST['ectc']);// required
   $city = test_input($_POST['city']);// required



    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email)) {

    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

  }

  

  if(strlen($error_message) > 0) {

    died($error_message);

  }

    $email_message = "Form details below.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "First Name : ".clean_string($fname)."\n";
	 $email_message .= "Last Name : ".clean_string($lname)."\n";
	  $email_message .= "Email : ".clean_string($email)."\n";
	 $email_message .= "Number : ".clean_string($number)."\n";
  	$email_message .= "Experience : ".clean_string($baby)."\n";
    $email_message .= "Current CTC: ".clean_string($cctc)."\n";
	$email_message .= "Expected CTC: ".clean_string($ectc)."\n";
	$email_message .= "City: ".clean_string($city)."\n";

 $attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
        $filename = $_FILES['file']['name'];

        $boundary =md5(date('r', time())); 

        $headers = "From: $fname \r \n Reply-To: $email";
        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

// create email headers

        $email_message = "This is a multi-part message in MIME format.

--_1_$boundary
Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

--_2_$boundary
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

	Application Recieved \n Applicant Mail Adddress : $email \n First Name : $fname \n Last Name : $lname \n Number : $number \n Experience : $baby \n  Current CTC : $cctc \n  Expecting CTC : $ectc \n  City : $city \n 



--_2_$boundary--
--_1_$boundary
Content-Type: application/octet-stream; name=\"$filename\" 
Content-Transfer-Encoding: base64 
Content-Disposition: attachment 

$attachment
--_1_$boundary--";


if(@mail($email_to, $email_subject, $email_message,$headers))
{

header('Location:pop1.html');
exit();
}
else
{
echo "failed";
}


?>




<?php

}

?>