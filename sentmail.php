<?php

if(isset($_POST['submit'])) {



    // EDIT A LINE BELOW AS REQUIRED

    $email_to = "jobs@jobsheight.in";

    // Custome your email subject

    $email_subject = "Employer login Application";





    function died($error) {

        // your error code can go here

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";

        echo "These errors appear below.<br /><br />";

        echo $error."<br /><br />";

        echo "Please go back and fix these errors.<br /><br />";

        die();

    }



    // validation expected data exists

    if(!isset($_POST['name']) ||
		 !isset($_POST['cname']) ||
		  !isset($_POST['desg']) ||
		   !isset($_POST['baby']) ||
        !isset($_POST['number']) ||

        !isset($_POST['city']) ||
		
		

		!isset($_POST['message'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


   $name = test_input($_POST['name']);// required
    $desg = test_input($_POST['desg']);// required
	 $cname = test_input($_POST['cname']);// required 
	 $baby = test_input($_POST['baby']);// required 
	 $number = test_input($_POST['number']);// required
   $city= test_input($_POST['city']);// required
   $message = test_input($_POST['message']);// required


  

    $email_message = "Form details below.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "Name : ".clean_string($name)."\n";
	$email_message .= "Company Name: ".clean_string($cname)."\n";
	$email_message .= "Desg: ".clean_string($desg)."\n";
	$email_message .= "Experience : ".clean_string($baby)."\n";
	 $email_message .= "Number : ".clean_string($number)."\n";
    $email_message .= "City : ".clean_string($city)."\n";
	$email_message .= "Message : ".clean_string($message)."\n";

 



// create email headers

$headers = 'From: '.$name."\r\n".

'Reply-To: '.$name."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);


header('Location:pop2.html');
exit();

?>



<!-- include your own success html here -->



Thank for your reservation. We will be in touch with you very soon.



<?php

}

?>