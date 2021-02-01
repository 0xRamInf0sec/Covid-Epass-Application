<?php 
  session_start();
  if(!isset($_SESSION['mail']))
  {
	  header('frontpage.php');
  }
?>
<?php

  if (isset($_POST['submit'])) { 
  
  if(isset($_POST) & !empty($_POST)){
	   $_SESSION['travlercount'] = $_POST['travlercount'];
	   $_SESSION['fromdis'] = $_POST['fromdis'];
	   $_SESSION['todis'] = $_POST['todis'];
	   $_SESSION['reason'] = $_POST['reason'];
	   $_SESSION['vnum'] = $_POST['vnum'];
	   
	  
  	  if($_POST['cars'] == "BIKE" && $_POST['travlercount'] >2)
	  {
		  //echo "\n <font face='cambria'> More than 2 members are not allowed, Please change!";
		  echo "<font face='cambria'> <div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>More than 2 members are not allowed for BIKE, Please change!</h4>
  </div>"; 
	  }
	  else if($_POST['cars'] == "CAR" && $_POST['travlercount'] >4)
	  {
		  echo "<font face='cambria'><div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>More than 4 members are not allowed, Please change!</h4>
  </div> ";
		  //echo "\n <font face='cambria'> More than 4 members are not allowed, Please change!";
	  }
	  else if($_POST['cars'] == "VAN" && $_POST['travlercount'] >8)
	  {
		  echo "<font face='cambria'><div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>More than 8 members are not allowed, Please change!</h4>
  </div>";
		  //echo "\n <font face='cambria'> More than 8 members are not allowed, Please change!";
	  }
	  else if($_POST['travlercount']=="")
	  {
		  echo "<font face='cambria'> <div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>Enter Passenger Count</h4>
  </div>";
		  //echo "\n <font face='cambria'> Enter Passenger Count";
	  }
	  else if($_POST['fromdis']==$_SESSION['todis'])
	  {
		  echo "<font face='cambria'> <div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>From and To District cannot be same, Please Change!</h4>
  </div>";
		  //echo "\n <font face='cambria'> Enter Passenger Count";
	  }
	  else if(empty($_POST['reason']))
	  {
		  echo "<font face='cambria'> <div style='background-color:red;text-align:center;padding:10px;'>
  <h4 style='color:white'>Reason is mandatory</h4>
  </div>";
		  //echo "\n <font face='cambria'> Enter Passenger Count";
	  }
	  else
	  {
		  echo "<div style='background-color:green;text-align:center;padding:10px;'>
  <h4 style='color:white'>Success.....</h4>
  </div>";
	  header ("refresh:0.5;url=PersonDetails.php");
	  }
  }}
  ?>
<html>
    <head>
        <title>FromDisToDis</title>
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
      
    }
    #log1{
     text-align:center;
      color:#ffffff;
      font:small-caps bolder 28px arial;
   
    }
    form{
    width: 100%;
    margin: 60px auto;
	margin-right: 80px;
	margin-left: -10px;
	margin-top: 5px;
    height:150 px;
	padding:50px 0;
	padding:50px 0;
	display: flex;
	flex-wrap:wrap;
	justify-content: space-around;
	background-color: rgba(255,255,255,0.5);
	float:none;
    }
	p {
	  position: absolute;
	  left: 400px;
	  top: 540px;
	  color: red;
	}
    body{
       background-image:url("stay-home-stay-safe.jpg");
	   background-repeat:no-repeat;
       background-size:30% 48%;
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

  <form method = "post" action="FromDisToDis.php">
  <div class="col-sm-5">
  <div class="panel panel-primary">
  <div class="panel-heading text-center">
      <h4 id="log1" style="font-family: cambria;">E-PASS</h4>
  </div>
  <div class="panel-body">
  <form action="FromDisToDis.php" opacity:1 >
  <label name="mode" style="font-family: cambria;">Travel Mode</label>
  &nbsp &nbsp <select name="cars" id="cars" value="<?php echo htmlspecialchars($_POST['cars'] ?? '', ENT_QUOTES); ?>" style="font-family: cambria;">
    <option value="BIKE">&nbsp Bike</option>
    <option value="CAR">&nbsp Car</option>
    <option value="VAN">&nbsp Van</option>
  </select>
  <label for="number" style="font-family: cambria;"> &nbsp &nbsp &nbsp &nbsp Travellers</label>
  &nbsp <input type="number" name="travlercount" value="<?php echo htmlspecialchars($_POST['travlercount'] ?? '', ENT_QUOTES); ?>" size="4">
  
  <br> <br> <label name="LabfromDis" style="font-family: cambria;">From District</label>
  <?php

	$mysqli = new mysqli('localhost', 'Projectphp', 'php123!@#', 'tnepass');

	if($mysqli->connect_error) 
	  die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());


	$query = "SELECT * FROM tn_districts";
	$result = mysqli_query($mysqli, $query);

	?>

	&nbsp <select name="fromdis" value="<?php echo htmlspecialchars($_POST['fromdis'] ?? '', ENT_QUOTES); ?>" style="font-family: cambria;">
	<?php
	while ($row = mysqli_fetch_array($result)) {
		echo "<font face='cambria'> <option value='" . $row['Dis_Name'] . "'>" . $row['Dis_Name'] . "</option>";
	}
	?>
	</select>
	
	&nbsp &nbsp  <label name="LabToDis" style="font-family: cambria;">To District</label>
	<?php

	$mysqli = new mysqli('localhost', 'Projectphp', 'php123!@#', 'tnepass');

	if($mysqli->connect_error) 
	  die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());


	$query = "SELECT * FROM tn_districts";
	$result = mysqli_query($mysqli, $query);

	?>

	&nbsp <select name="todis" value="<?php echo htmlspecialchars($_POST['todis'] ?? '', ENT_QUOTES); ?>" style="font-family: cambria;">
	<?php
	while ($row = mysqli_fetch_array($result)) {
		echo "<font face='cambria'> <option value='" . $row['Dis_Name'] . "'>" . $row['Dis_Name'] . "</option>";
	}
	?>
	</select>
  <br><br>
  <label for="vnum" style="font-family: cambria;"> Vehicle Number</label>
  <br> <input type="text" name="vnum" value="<?php echo htmlspecialchars($_POST['vnum'] ?? '', ENT_QUOTES); ?>" size="25" style="font-family: cambria;">
  <br><br>
  <label for="reason" style="font-family: cambria;"> Reason</label>
  <br> <input type="text" name="reason" value="<?php echo htmlspecialchars($_POST['reason'] ?? '', ENT_QUOTES); ?>" size="25" style="font-family: cambria;">
  <br><br>
  
  <input type = "submit" name = "submit" value = "Submit" onclick = "PersonDetails.php" class="btn btn-success" style="font-family: cambria;">
  &nbsp &nbsp <a href="secondpage.php " style="font-family: cambria;">Back</a>

  
</form>
  </div>
  </div>
  </div>
  </form>
  
    </body>
