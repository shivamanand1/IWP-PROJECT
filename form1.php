<?php
session_start();
if(isset($_GET['vname']))
$vname=$_GET['vname'];
if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['uname']);
	header('Location:login.php');
}
?>

<html>
<head>
<link rel="stylesheet" href="nav.css">
<style>
body{
margin:0;
padding:0;
font:family:Bell MT;
background-repeat:no-repeat;
background-size: 100% 200%;
}

.main1{
	position:absolute;
	top:15%;
	left:32%;
    width: 36%;
	background-color:white;
	padding:2%;
	border-radius:10px;
	margin-bottom:2%;
}

.textbox{
width: 100%;
overflow: hidden;
font-size: 20px;
padding: 8px 0;
margin: 8px 0;
border-bottom: 2px solid gray;
}

.textbox input{
border: none;
outline: none;
background: none;
color: black;
font-size: 18px;
width: 80%;
float:left;
margin:0 10px;
font-weight:bold;
}

.textbox select{
border: none;
outline: none;
background: none;
color: black;
font-size: 18px;
width: 80%;
float:left;
margin:0 10px;
font-weight:bold;
}

.a{
border: none;
width: 100%;
font-size: 14px;
padding: 8px 0;
margin: 8px 0;
border-bottom: 2px solid gray;
font-weight:bold;
}

::placeholder { 
  color: lightgray;
}

.sub{
color: white;
padding:5px 20px;
border: 1px solid transparent;
transition: 0.6s ease;
text-decoration: none;
background-image:url("formbg.jpg");
background-size:cover;
border-radius:18px;
width:75%;
height:45px;
font-size:20px;
}

button:hover{
background-image:url("subbg1.jpg");
color: black;
background-size:cover;
content: "hello";
}
button:hover span {display:none;}

button:hover:before 
{content:"Submit ->";
word-spacing: 15pt}

.sel{
border: none;
outline: none;
background: none;
color:white;
font-size: 17px;
transition: 0.6s ease;
font-family: Century Gothic;
}

.sel:hover{
background-color:white;
color:black;
}

</style>


</head>
<body background="formbg.jpg">
<div class="main">
<div class="logo">
<img src="logo1 - Copy.png" alt="hello">
</div>
<ul>
<li class="active"><a href="home.php">Home</a></li>
<li><a href="showvenue.php">Book now</a></li>
<li><a href="checkloginv.php">Add venue</a></li>
<li><a href="showevents.php">Upcoming Events</a></li>
<li><a href="addevent.php">Create Event</a></li>
<li><a href="services.php">Services</a></li>
<?php
if(isset($_SESSION['uname']))
{
	?>
	<li><select name="f1" onchange="location = this.value;" class="sel">
	<option disabled selected><?php echo($_SESSION['uname']);?> <i class="fa fa-user-circle-o" style="font-size:24px;color:white"></i></option>
	<option value="mybook.php">My bookings</option>
	<option value="?logout='1'">Log out</option>
</select>
</li>
<?php
}
else{
	?>
<li><select name="f1" onchange="location = this.value;" class="sel">
<option disabled selected>Login <i class="fa fa-user-circle-o" style="font-size:24px;color:white"></i></option>
 <option value="login.php">Login</option>
 <option value="signup.php">Sign up</option>
</select>
</li>
<?php	
}
?>

</ul>
</div>


<div class="main1">
<form action="" method="POST">
Your Name
<div class="textbox">
<input type="text" placeholder="Enter Your Name" name="name" required>
</div><br>

Email
<div class="textbox">
<input type="email" placeholder="Enter Your Email Address" name="em" required>
</div><br>

Number of Attendees(approx)
<div class="textbox">
<input type="number" placeholder="Enter count" name="num" required>
</div><br>

Date Of Event
<div class="textbox">
<input type="date" name="date" required>
</div><br>

Occasion
<div class="textbox">
<select class="sel" name="occ">
<option disabled selected>Select your option</option>
<option value="Corporate Meeting">Corporate Meeting</option>
<option value="Wedding">Wedding</option>
<option value="Birthday party">Birthday party</option>
<option value="Anniversary">Anniversary</option>
<option avlue="Other">Other</option>
</select>
</div><br>


Budget Per Person
<div class="textbox">
<select class="sel" name="budget">
<option disabled selected>Select Budget</option>
<option value="Below Rs.300">Below Rs.300</option>
<option value="Rs.300-400">Rs.300-400</option>
<option value="Rs.300-500">Rs.300-500</option>
<option value="Rs.500 +">Rs.500 +</option>
</select>
</div><br>
Requirements<br>
<textarea rows=8 class="a" placeholder="Explain your requirements in detail" name="req">
</textarea><br><br>
<input type="text" value="<?php echo $vname ?>" name="vname" hidden>
<center><button type="submit" name="s0" value="Submit" class="sub"><span>Submit &#8594 </span></center>
</form>
</div>

</body>
</html>

<?php

$conn = mysqli_connect('localhost','root','','eventmanagement');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['s0'])){
	if(!isset($_SESSION['uname']))
	{
		echo '<script type="text/javascript">alert("Please Login first");window.location.href="login.php";</script>';
		exit();

	}
	$vname=$_POST['vname'];
	$un=$_SESSION['uname'];
	$name=$_POST['name'];
	$em=$_POST['em'];
	$num=$_POST['num'];
	$date=$_POST['date'];
	$occ=$_POST['occ'];
	$budget=$_POST['budget'];
	$req=htmlspecialchars($_POST['req']);
	$sql = "insert into bookings values('$un','$name','$vname','$em','$num','$date','$occ','$budget','$req')";

if(mysqli_query($conn,$sql))
{
	echo '<script type="text/javascript">alert("Venue booked successfully");</script>';
}


}
mysqli_close($conn);

?>

