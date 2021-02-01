<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:adminlogin.php");
}
?>
<html>
    <head>
        <title>Admin Page</title>
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
		margin-left:29%;
      height:150 px;
      padding:40px 0;
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
	
	table {
		border-collapse: collapse;
		width: 100%;
		table-layout: auto;
		color: #588c7e;
		font-family: cambria;
		font-size: 18px;
		text-align: center;
		border: 0.5px solid black;
		background-color: rgba(255,255,255,0.5);
		position: absolute;
		left: 0px;
		top: 170px;
		color: black;
        }
th {
		background-color: #588c7e;
		font-family: cambria;
		color: white;
		border: 0.5px solid black;
}
td{
	border: 0.5px solid black;
   }
		

    </style>
    </head>
    <body >
  <div class="container-fluid container_decor">
	<h1 style="font-family: cambria;color: white;height: 6%;margin-left: 45%;margin-top: 1%;";>TN e-Pass</h1>
	<h5 style="font-family: arial;color: white; height: 1.5%;text-align: center; "><b>Tamil Nadu e-Pass Application Portal</b></h5>
  </div>
<h3 style="text-align:center">Accepted and Rejected E-PASS LIST</h3>
  <table  style = opacity:1>
  <col width="100">
<th>Login Id</th>
<th>Email Id</th>
<th>Apply Time</th>
<th>Action Time</th>
<th>Noof Travellers</th>
<th>From District</th>
<th>From CC</th>
<th>To District</th>
<th>To CC</th>
<th>Pass Status</th>

<?php
$conn = mysqli_connect("localhost", "Projectphp", "php123!@#", "tnepass");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM tn_login ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row

while($row = $result->fetch_assoc()) {
	$id=$row["Login_id"];
echo "<tr><td>". $row["Login_id"]. "</td><td>" . $row["Email_id"] . "</td><td>" . $row["Apply_Time"] . "</td><td>". $row["Action_Time"]."</td><td>". $row["Noof_Travellers"] . "</td><td>". $row["From_District"] . "</td><td>". $row["From_CC"] . "</td><td>". $row["To_District"] . "</td><td>". $row["To_CC"] . "</td><td>". $row["status"] ."</td></tr>"; 
}

} else { echo "0 results"; }

$conn->close();

?>
<?php if(isset($_POST) & !empty($_POST)){

	print_r ($_POST);
}

?>
</table>

</body>
</html>