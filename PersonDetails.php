<html>
    <head>
        <title>DETAILS</title>
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
      font: 28px cambria;
    }
    #log1{
     text-align:center;
      color:#ffffff;
      font:28px cambria;
	  height:5 px;
   
    }
    form{
       width: 100%;
        margin:70 px auto;
      height:150 px;
	  background-color: rgba(255,255,255,0.5);
      align-items:center;
      justify-content: space-around;
        display: flex;
        float:none;
    }
    body{
       
            background-image: url("covid.jpg");
          background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
    }
	p {
	  position: absolute;
	  left: 470px;
	  top: 90px;
	  color: red;
	  font-size: 20px;
	}   
   
    </style>
    </head>
	
	
	<?php
	session_start();
	$_SESSION['Result'] = "";
	if(isset($_POST) & !empty($_POST)){
	if (isset($_POST['submit'])) { 
	//print_r ($_POST);
	$m=0;
	$date = date('d-m-y h:i:s');
	$_SESSION['date'] =  $date;
	
	//Logic to pull number of records in Login table
	$conn = new mysqli('localhost', 'Projectphp', 'php123!@#', 'tnepass');
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}	
		
		$sql1 = "SELECT COUNT(*) FROM tn_login";
		$sql_frmdis = "SELECT case_count FROM tn_districts WHERE Dis_Name = ". "'".$_SESSION['fromdis']."'";
		$sql1_todis = "SELECT case_count FROM tn_districts WHERE Dis_Name = " . "'". $_SESSION['todis']."'";
		$result_login = $conn->query($sql1);
		$result_frmdis = $conn->query($sql_frmdis);
		$result_todis = $conn->query($sql1_todis);
		if ($result_login->num_rows > 0) {
		
			$logincount = $result_login->fetch_array()[0] ?? '';
			$_SESSION['logincount'] = $logincount+1;
			}
		 else {
		  echo "<font face='cambria'> <p>" . $conn->error."</p>";
		  echo "Error:" . $conn->error;
		  //echo "Error: " . $sql . "<br>" . $conn->error;
		}
		if ($result_frmdis->num_rows > 0) {
		
			$FromCC = $result_frmdis->fetch_array()[0] ?? '';
			$_SESSION['FromCC'] = $FromCC;
			}
		 else {
		  echo "<font face='cambria'> <p>" . $conn->error."</p>";
		  //echo "Error:" . $conn->error;
		  echo "Error: " . $sql_frmdis . "<br>" . $conn->error;
		}
		if ($result_todis->num_rows > 0) {
		
			$ToCC = $result_todis->fetch_array()[0] ?? '';
			$_SESSION['ToCC'] = $ToCC;
			}
		 else {
		  echo "<font face='cambria'> <p>" . $conn->error."</p>";
		  //echo "Error:" . $conn->error;
		  echo "Error: " . $sql_todis . "<br>" . $conn->error;
		}
	

	while($m<$_SESSION['travlercount']) {
    $m++;	
	$_SESSION['agevalue'] = $_POST[$m . 'age'];
	$_SESSION['aadhar']=$_POST[$m . 'Aadharnumb'];
	$_SESSION['name']=$_POST[$m . 'imp_name'];
	$_SESSION['gender']=$_POST[$m . 'gender'];
	$_SESSION['name']=$_POST[$m.'imp_name'];
	if(!empty($_POST[$m . 'imp_name']) && !empty($_POST[$m . 'Aadharnumb']) && !empty($_POST[$m . 'age']) && !empty($_POST[$m . 'gender']) && !empty($_POST[$m . 'mob_number']))
	{
		echo "Tes Check";
        //foreach ( $_POST as $key => $value )
		$conn = new mysqli('localhost', 'Projectphp', 'php123!@#', 'tnepass');
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}	
		
		$sql = "INSERT INTO tn_citizendetail (Login_id,Aadhar_Numb, Age, Gender, Mobile, Name, From_District, To_District , status)
		VALUES ('". $_SESSION['logincount']. "','". $_POST[$m . 'Aadharnumb']. "','". $_POST[$m . 'age']."','".$_POST[$m . 'gender']."','".$_POST[$m . 'mob_number']."','".$_POST[$m . 'imp_name']."','".$_SESSION['fromdis']."','".$_SESSION['todis']."','waiting')";
		
		$sql_login = "INSERT INTO tn_login (VehicleNumber,Reason,Email_id,Login_id,Apply_Time, Action_Time, Noof_Travellers, From_District, From_CC, To_District ,To_CC, pass_status,status)
		VALUES ('".$_SESSION['vnum']."','".$_SESSION['reason']."','".$_SESSION['mail']."','". $_SESSION['logincount']. "','". $_SESSION['date'] ."','". $_SESSION['date'] ."','".$_SESSION['travlercount']."','".$_SESSION['fromdis']."',".$_SESSION['FromCC'].",'".$_SESSION['todis']."',".$_SESSION['ToCC'].",'waiting','waiting')";

		if($_POST[$m . 'age'] <60 && $_SESSION['ToCC'] < 5000){
		if ($conn->query($sql) === TRUE && $conn->query($sql_login) === TRUE) {
		  echo $_SESSION['Result']= $_POST[$m . 'imp_name'] . "E-Pass successfully <br>";
		} else {
		  echo "<font face='cambria'> <p>" . $conn->error."</p>";
		  //echo "Error:" . $conn->error;
		  echo "Error: " . $sql_login . "<br>" . $conn->error;
		}}

		else if (($_POST[$m . 'age'] >60) || ($_POST[$m . 'age'] <10)) {
			if ($conn->query($sql) === TRUE && $conn->query($sql_login) === TRUE)
			{

			header ("Location: LastPage.php");
			}
		}
		else {
			if ($conn->query($sql) === TRUE && $conn->query($sql_login) === TRUE)
			{
			header ("Location: LastPage.php");
			}
		}

		$conn->close();
		} 
	}
	if(empty($_POST[$m . 'imp_name']) || empty($_POST[$m . 'Aadharnumb']) || empty($_POST[$m . 'age']) || empty($_POST[$m . 'gender']) || empty($_POST[$m . 'mob_number']))
	{
	  echo "<font face='cambria'> <p>All fields are mandatory</p>";
	}
	if(!empty($_SESSION['Result']))
	{
		echo $_SESSION['Result'];
		header ("Location: LastPage.php");
	}		
	}
	}
	?>
    <body>
    <div class="container-fluid container_decor">
	<h1 style="font-family: cambria;color: white;height: 6%;margin-left: 45%;margin-top: 1%;";>TN e-Pass</h1>
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass Application Portal</b></h5>
  </div>
	
    <?php
	$n=0;
	while($n<$_SESSION['travlercount']) {
    $n++;
    $_SESSION["numb"] = $n;
	$_SESSION["name"] = $n . 'imp_name';
	$_SESSION["mob_number"] = $n . 'mob_number';
	$_SESSION["age"] = $n . 'age';
	$_SESSION["gender"] = $n . 'gender';
	$_SESSION["Aadharnumb"] = $n . 'Aadharnumb';
	$_SESSION["Reason"]=$n.'Reason';
	$_SESSION["otp_checker"] = $n. 'otp_checker';
    ?>
	    <form method = "post" opacity:1>
	  <div class="col-sm-4">
	  <div class="panel panel-primary">
	  <div class="panel-heading text-center">
	      <h4 id="log1"><label style="font-family: cambria;" for=<?php print $_SESSION["numb"]; ?>>Detail - <?php print $_SESSION["numb"]; ?></label></h4>
	  </div>
	  <div class="panel-body">
	  <div class="form-group">
	    <label for=<?php print $_SESSION["name"];?> style="font-family: cambria;">Name</label>
	    <input type="text" style="font-family: cambria;" name= <?php print $_SESSION["name"];?> value="<?php echo htmlspecialchars($_POST[$_SESSION["name"]] ?? '', ENT_QUOTES); ?>" class="form-control input-lg">
	   

	  </div>
	  <div class="form-group">
	    <label for=<?php print $_SESSION["mob_number"];?> style="font-family: cambria;">Mobile Number</label>
	    <input type="text" style="font-family: cambria;" name= <?php print $_SESSION["mob_number"];?> value="<?php echo htmlspecialchars($_POST[$_SESSION["mob_number"]] ?? '', ENT_QUOTES); ?>" class="form-control input-lg" >
	   

	  </div>
	  <div class="form-group">
	    <label for=<?php print $_SESSION["age"];?> style="font-family: cambria;">Age</label>
	    <input type="text"  style="font-family: cambria;" name= <?php print $_SESSION["age"];?> value="<?php echo htmlspecialchars($_POST[$_SESSION["age"]] ?? '', ENT_QUOTES); ?>" class="form-control input-lg" >
	   

	  </div>
	  <div class="form-group">
	    <label for=<?php print $_SESSION["gender"];?> style="font-family: cambria;">Gender</label>
	    <input type="text" style="font-family: cambria;" name=<?php print $_SESSION["gender"];?> value="<?php echo htmlspecialchars($_POST[$_SESSION["gender"]] ?? '', ENT_QUOTES); ?>" class="form-control input-lg">
	   

	  </div>

	  <div class="form-group">
	    <label for=<?php print $_SESSION["Aadharnumb"];?> style="font-family: cambria;">Aadhar No</label>
	    <input type="text" style="font-family: cambria;" name=<?php print $_SESSION["Aadharnumb"];?> value="<?php echo htmlspecialchars($_POST[$_SESSION["Aadharnumb"]] ?? '', ENT_QUOTES); ?>" class="form-control input-lg">
	  </div>	   
	   
	  </div>
	  </div>
	  </div>
    <?php
}?>
	</body>
	<div>
	
	<input type = "submit" name = "submit" value = "Submit" id="bt_sub" onclick = "LastPage.php" class="btn btn-success btn-block" style="font-family: cambria;">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp
	&nbsp &nbsp &nbsp
	<a href="FromDisToDis.php" style="font-family: cambria;">Back</a>
	<br>
	</div>
	</form>
	</body>
	</html>
	
    