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
		margin-left:-2%;
      height:150 px;
      padding:60px 0;
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
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass Application Portal</b></h5>
  </div>
  <form method = "post" opacity:1>
  <div class="col-xs-5">
  <div class="panel panel-primary">
  <div class="panel-heading text-center">
      <h4 id="log1" style="font-family: cambria;" >Admin Login</h4>
  </div>
  <div class="panel-body">
  <div class="form-group">
    <label for="name" style="font-family: cambria;">User Name</label>
    <input type="text" name="name" style="font-family:cambria;" class="form-control input-lg" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>" id="name"  >
   

  </div>

  <div class="form-group">
    <label for="Password" style="font-family: cambria;" > Enter your Password</label>
    <input type="password" name="Password" style="font-family:cambria;" class="form-control " value="<?php echo htmlspecialchars($_POST['Password'] ?? '', ENT_QUOTES); ?>" id="name">
   
  </div>
  	  <?php
	 session_start();
	 $user="";
	 $pass="";
	 if(isset($_POST['sub']))
	 {
	 $user=$_POST['name'];
	    $pass=$_POST['Password'];
		if(isset($_POST) & !empty($_POST)){
		if(empty($_POST['name']) || empty($_POST['Password'])){
			echo "<font face='cambria'> <p>Username or Password is wrong @@</p>";
		}
		 
		else if($user == "Admin" && $pass == "Admin@12"){
			$_SESSION['user']=$user;
		   header("location:adminmod.php");
		}
		else 
		{
			echo "<font face='cambria'> <p>Username or Password is wrong</p>";
		}
		}
	 }
		?>

  <input type="submit" value="Submit" name="sub" style="font-family: cambria;">
 
 

  </div>
  </div>
  </div>
  </form>

 