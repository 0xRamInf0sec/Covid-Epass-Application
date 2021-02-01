<html>
    <head>
        <title>Last Page</title>
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
        margin-top: 1px;
		margin-left:-3%;
		margin-bottom:-10%;
      height:100 px;
      padding:40px 0;
      align-items:center;
      justify-content: space-around;
        display: flex;
        float:none;
		opacity:5;
    }
    body{
       background-image:url("stay-home-stay-safe.jpg");
	   background-repeat:no-repeat;
       background-size:30% 58%;
       background-position:430px 160px;
	   opacity:0.9;
	   
    }
	
	
	p {
	  position: absolute;
	  left: 120px;
	  top: 339px;
	  color: red;
	}
		
#but {
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
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass Application Portal</b></h5>
  </div>
  <form method = "post" >
  <div class="col-xs-5">
  <div class="panel panel-primary">
  <div class="panel-heading text-center">
      <h4 id="log1" style="font-family: cambria;" >e-Pass</h4>
  </div>
  <div class="panel-body">
  <div class="form-group">
  <?php
  session_start();
    $aadhar=$_SESSION['aadhar'];
	if($_SESSION['agevalue']>60 || $_SESSION['agevalue'] < 10)
	{
		echo "<br><font face='cambria'> <label>Dear Applicant! It is not advised to travel with elderly person/children in this pandemic. Your applicaion is rejected and travelling is restriced as of now.</label>";
		$con=mysqli_connect("localhost","Projectphp","php123!@#","tnepass");
		$sql_stmt='update tn_citizendetail set status="Rejected" where Aadhar_Numb='.$aadhar;
		$result=mysqli_query($con,$sql_stmt);
		$sq='update tn_login set pass_status="Rejected",status="Rejected" where Login_id='.$_SESSION['logincount'];
		$r=mysqli_query($con,$sq);
	}
	else if($_SESSION['ToCC']>5000)
	{
		$con=mysqli_connect("localhost","Projectphp","php123!@#","tnepass");
		echo "<br><font face='cambria'> <label>Dear Applicant! It is not advised to travel to any corono-red zones. Your applicaion is rejected and travelling is restriced as of now.</label>";
		$sql_stmt='update tn_citizendetail set status="Rejected" where Aadhar_Numb='.$aadhar;
		$result=mysqli_query($con,$sql_stmt);
		$sq='update tn_login set pass_status="Rejected",status="Rejected" where Login_id='.$_SESSION['logincount'];
		$r=mysqli_query($con,$sq);
		if($r==TRUE)
		{
			echo "NOT APPROVED";
		}
	}
	else
	{
		$con=mysqli_connect("localhost","Projectphp","php123!@#","tnepass");
		$sql_stmt='update tn_citizendetail set status="Approved" where Aadhar_Numb='.$aadhar;
		$result=mysqli_query($con,$sql_stmt);
		$msg="Approved,From:".$_SESSION['fromdis']."TO:".$_SESSION['todis']."";
		$str='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$msg;
		$sq="update tn_login set pass_status='{$str}',status='Approved' where Login_id=".$_SESSION['logincount'];
		$r=mysqli_query($con,$sq);
		$s="select VehicleNumber from tn_login where Login_id=".$_SESSION['logincount'];
		$res=mysqli_query($con,$s);
		if(mysqli_num_rows($res)>0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				$vno=$row['VehicleNumber'];
			}
		}
		echo '<br><font face="cambri"> <label>Your Application for E-Pass has been submitted successfully</label>
		<h3 style="text-align:center;background-color:#66c7e6">E-PASS</h3><br>
	     Vehicle Number : '.$vno.'<br>
		<h4>Referral ID : <b>'.$_SESSION['logincount'].'</b></h4><br>
		 From : '.$_SESSION['fromdis'].'<br>
		 To : '.$_SESSION['todis'].'<br>
		 email :'.$_SESSION['mail'].'<br>
		 Aadhar Number (One person) : '.$_SESSION['aadhar'].'<br>
		 <b>Reason : '.$_SESSION['reason'].'</b><br>
		 <br><br>
		 ************Stay Home Stay Safe stay healthy************<br><br>';
		 
		 echo '<h3>Your QR Code </h3>';
		 
		 if(mail($_SESSION['mail'],"FOR EPASS APPLICATION","Your EPASS HAS BEEN APPROVED ,Your REFFERAL ID :".$_SESSION['logincount']." .","From:team28bootathon@gmail.com"))
		 {
			 echo "<script>alert('success')</script>";
		 }
		 else
		 {
			 echo "<script>alert('error')</script>";
		 }
	echo "<img src=https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={$str}>";
	echo '<br><br>';
	echo '<b style="text-align:center;color:#4c68e6">*Note : To Download The Epass Press ctrl+p</b>';
	echo '<button id="but" onclick=window.print()>Print The Epass</button>';
	}
  ?>
  
      </div>


  </div>
  </div>
  </form>

 