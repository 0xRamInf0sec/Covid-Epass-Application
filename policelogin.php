<html>
    <head>
        <title>Police portal</title>
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
		

    </style>
    </head>




    <body >
  <div class="container-fluid container_decor">
  
	<h1 style="font-family: cambria;color: white;height: 6%;margin-left: 45%;margin-top: 1%;";>TN e-Pass</h1>
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass police verification Portal</b>
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
    <label for="vehicle" style="font-family: cambria;">Enter the vehicle Number</label>
    <input type="text" name="vno" style="font-family:cambria;" class="form-control input-lg" id="name"  >
   

  </div>

  <input type="submit" value="Submit" name="submit">
  <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

               $vno= test_input($_POST["vno"]);
            }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		 if(isset($_POST['submit']))
		 {
			 $con=mysqli_connect("localhost","Projectphp","php123!@#","tnepass");
			 $query="select * from tn_login where VehicleNumber='{$vno}'";
			 $res=mysqli_query($con,$query);
			 if(mysqli_num_rows($res)>0)
			 {
				 while($row=mysqli_fetch_assoc($res))
				 {
					$log_id=$row['Login_id'];
					$qr=$row['pass_status'];
				 }
				 $q="select * from tn_citizendetail where Login_id='{$log_id}'";
			 $r=mysqli_query($con,$q);
			 if(mysqli_num_rows($r)>0)
			 {
				 while($row=mysqli_fetch_assoc($r))
				 {
					 $name=$row['Name'];
					 $age=$row['Age'];
					 $mob=$row['Mobile'];
					 $aad=$row['Aadhar_Numb'];
					 $stat=$row['status'];
				 }
				 echo '<br>';
				 
			 echo '<b> Name : </b>'.$name.'<br>';
			 echo '<b> Age : </b>'.$age.'<br>';
			 echo '<b> Mobile Number : </b>'.$mob.'<br>';
			 echo '<b> Aadhar Number : </b>'.$aad.'<br>';
			 echo '<b> Vehicle Number : </b>'.$vno.'<br>';
			 echo '<h4>Status : </h4>';
			 if($stat=='Approved')
			 {
			 echo "<div style='background-color:green;text-align:center;padding:10px;'>
  <h4 style='color:white'>".$stat."</h4>
  </div>";
  echo '<h4> Scan the qrcode </h4>';
  echo "<img src=https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='{$qr}'>";
			 }
			 else
			 {
				  echo "<div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>".$stat."</h4>
  </div>";
			 }
			 
			 }
			 
		 }
		 else
		 {
			 echo "<div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>VEHICLE NUMBER NOT EXISTS</h4>
  </div>";
		 }
			 }
			 
?>
  </div>
  </div>
  </div>
  </form>

 