<?php
 session_start();
$mail= $_SESSION['mail'];
                function writeMsg() 
				{
                return rand(1000000,9999999);
                }
                 $otp=writeMsg();
				 $_SESSION['otp']=$otp;
				 $body="This is your OTP ".$otp." for Covid E-pass Login.\n\r Thank You ";

                 if(mail($mail,"OTP Verification",$body,"From:team28bootathon@gmail.com"))
                 {
	               header("Location:secondpage.php");
                 }
                else
				 {
	              echo '<script>alert("OTP Unsuccessfull")</script>';
				  header('refresh:0.1,url=frontpage.php');
                }
?>