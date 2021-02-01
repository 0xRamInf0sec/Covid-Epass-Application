<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

               $email= test_input($_POST["email"]);
               $captcha = test_input($_POST["captcha1"]);
			   $cap=test_input($_POST['enteredcaptcha']);
            }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		 if(isset($_POST['submit']))
		 {
			 
		 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              echo "<div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>INVALID EMAIL , Please Re-Enter the EMAIL</h4>
  </div>";
  header( "refresh:1;url=frontpage.php" );
}
else if($captcha!=$cap)
{
	echo "<div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>CAPTCHA Incorrect,Please Re-Enter the CAPTCHA</h4>
  </div>";
  header( "refresh:1;url=frontpage.php" );
}
else
{
	$_SESSION['mail']=$email;
	echo "<div style='background-color:green;text-align:center;padding:10px;'>
  <h4 style='color:white'>Success wait for OTP...</h4>
  </div>";
  
header( "refresh:1;url=otpsender.php" );
}
		 }
?>
<html>
    <head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
    .container_decor{
		background-color:rgb(46,50,86);
		background-image:url('tn.jpg');
        background-repeat:no-repeat;
		background-size:70px 77px;
		background-position:10px 2px;
		margin-bottom:3%;
    }
	.container:before {
    box-shadow: inset 0 0 2000px rgba(255, 255, 255, .5);
	}
    .error {color: #FF0000;}
    #log{
     
      text-align:center;
      color:#000000;
      font:small-caps bolder 28px arial;
    }
    #log1{
     text-align:center;
      color:#ffffff;
      font:small-caps bolder 28px arial;
   
    }
    form{
    width: 100%;
        margin-top: 0px;
		margin-left:1%;
      height:150 px;
      padding:20px 0;
      align-items:center;
      justify-content: space-around;
        display: flex;
        float:none;
		opacity:0.9;
    }
    body{
       background-image:url("stay-home-stay-safe.jpg");
	   background-repeat:no-repeat;
       background-size:35% 58%;
       background-position:430px 160px;
	   opacity:0.9;
	   
    }
	
	
	p {
	  position: absolute;
	  left: 120px;
	  top: 339px;
	  color: red;
	}
	.navbar-nav{
	margin-left:auto;
}
input[type=submit] {
  background-color:#f23b3b;
  color: white;
  position: 10px 100 px;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  
}
		

    </style>
    </head>




    <body >
  <div class="container-fluid container_decor">
  
	<h1 style="font-family: cambria;color: white;height: 6%;margin-left: 45%;margin-top: 1%;";>TN e-Pass</h1>
	
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass Application Portal</b>
	
	 </h5>
	 
  </div>
   <marquee style="font-family: cambria ;background-color:lightyellow;font: 40%;direction:right;font-style:italic;color:red;height: 3%;">Passes are issued to students, migrants labours and pilgrims under age of 60 and not to other cases as of now.</marquee>
  
  <form method = "post" action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" opacity:1>
  <div class="col-xs-5">
  <div class="panel panel-primary">
  <div class="panel-heading text-center">
      <h4 id="log1" style="font-family: cambria;" >E-PASS</h4>
  </div>
  <div class="panel-body">
  <div class="form-group">
    <label for="email" style="font-family: cambria;">Email-Id</label>
    <input type="text" name="email" style="font-family:cambria;" class="form-control input-lg" id="name"  >
   

  </div>
   <div class="form-group">
    <label for="captcha1" style="font-family: cambria;" >Captcha</label>
    <input style="font-family:candara;" name="captcha1" class="form-control input-lg" id="name" value=<?php  include 'captcha.php';?> readonly>
   
  </div>
  <div class="form-group">
    <label for="enteredcaptcha" style="font-family: cambria;" > Enter your  Captcha</label>
    <input type="text" name="enteredcaptcha" style="font-family:cambria;" class="form-control" id="name">
   
  </div>
  <input type="submit" value="Submit" name="submit">

  </div>
  </div>
  </div>
  </form>

 