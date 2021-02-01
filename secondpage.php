<?php
session_start();
$otpver= $_SESSION["otp"];
echo '<div style="background-color:green;text-align:center;padding:10px;"><h4 style="color:white">OTP SEND TO YOUR EMAIL : '.$_SESSION["mail"].'</h4></div>';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
			 if (empty($_POST["otp_checker"])) 
			 {
               $RegErr = "OTP required";
             }
			else 
			{
               $otp = test_input($_POST["otp_checker"]);
            }
}
function test_input($data)
{
	       $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
}
if(isset(($_POST['create'])))
{
	if($otp==$otpver)
	{
		echo "<div style='background-color:green;text-align:center;padding:10px;'>
  <h4 style='color:white'>OTP Verification successfull...</h4>
  </div>";
		header("refresh:1,url=FromDisToDis.php");
	}
	else{
		echo "<div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>OTP INCORRECT,Please Login Again...</h4>
  </div>";
		header("refresh:1,url=frontpage.php");
	}
}
?>

<html>
    <head>
        <title>OTP REFERAL PAGE</title>
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
		margin-left:-3%;
      height:150 px;
      padding:70px 0;
      align-items:center;
      justify-content: space-around;
        display: flex;
        float:none;
		opacity:0.9;
    }
    body{
       background-image:url("stay-home-stay-safe.jpg");
	   background-repeat:no-repeat;
       background-size:30% 50%;
       background-position:430px 160px;
	   opacity:0.9;
	   
    }
	
    </style>
    </head>
    <body>
  <div class="container-fluid container_decor">
	<h1 style="font-family: cambria;color: white;height: 6%;margin-left: 45%;margin-top: 1%;";>TN e-Pass</h1>
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass Application Portal</b></h5>
  </div>
  <form method = "post" action=""<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" opacity:1>
  <div class="col-sm-5">
  <div class="panel panel-primary">
  <div class="panel-heading text-center">
      <h4 id="log1">E-PASS</h4>
  </div>
  <div class="panel-body">
  <div class="form-group">
    <label for="otp_checker">Enter OTP</label>
    <input type="text" name="otp_checker" class="form-control input-lg" id="name">
   
  </div>
   <input type="Submit" value="Login" name="create" id="bt_sub" class="btn btn-success btn-block" >
  </div>
  </div>
  </div>
  </form>
    </body>
