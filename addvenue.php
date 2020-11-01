<?php
session_start();

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
<form action="" method="POST" enctype="multipart/form-data">
Venue Name
<div class="textbox">
<input type="text" placeholder="Enter Your Venue Name" name="name" required>
</div><br>

Email
<div class="textbox">
<input type="email" placeholder="Enter Your Email Address" name="email" value="" required>
</div><br>


Address
<div class="textbox">
<input type="text" name="address" placeholder="Enter Your Venue Address" value="" required>
</div><br>

Capacity of venue
<div class="textbox">
<input type="number" placeholder="Enter count" name="capacity" value="" required>
</div><br>

Cost Per Person
<div class="textbox">
<input type="number" placeholder="Enter approx cost in Rs." name="cost" value="" required>
</div><br>



Upload Venue Image
<div class="textbox">
<input type="file" name="userimg">
</div><br>
About Venue<br>
<textarea rows=8 class="a" placeholder="Explain your requirements in detail" name="about">
</textarea><br><br>
<center><input type="submit" value="Submit &#8594" class="sub" name="s1"><span> </span></center>
</form>
</div>



</body>
</html>


<?php
if(isset($_POST['s1']))
{
	if(!isset($_SESSION['uname']))
	{
		echo '<script type="text/javascript">alert("Please Login first");window.location.href="login.php";</script>';
		exit();

	}
	
$un=$_SESSION['uname'];
$vn=$_POST['name'];
$em=$_POST['email'];
$add=$_POST['address'];
$cap=$_POST['capacity'];
$cost=$_POST['cost'];
$about=htmlspecialchars($_POST['about']);

$mysqli = new mysqli('localhost','root','','eventmanagement') or die($mysqli->connect_error);

$temp=array();
$temp = explode(".", $_FILES["userimg"]["name"]);
$fname = $temp[0];

if ((($_FILES["userimg"]["type"] == "image/gif")
|| ($_FILES["userimg"]["type"] == "image/jpeg")
|| ($_FILES["userimg"]["type"] == "image/jpg")
|| ($_FILES["userimg"]["type"] == "image/pjpeg")
|| ($_FILES["userimg"]["type"] == "image/x-png")
|| ($_FILES["userimg"]["type"] == "image/png"))
&& ($_FILES["userimg"]["size"] < 800000))
  {
	
  if ($_FILES["userimg"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["userimg"]["error"] . "<br>";
    }
  else
    {
		$img_dir="images/" . $_FILES["userimg"]["name"];
		move_uploaded_file($_FILES["userimg"]["tmp_name"],$img_dir);
      echo '<script type="text/javascript">alert("Venue successfully added");</script>';	
	  
	  $sql="insert into venue values('$un','$vn','$add','$cap','$cost','$about','$img_dir','$em')";
      $mysqli->query($sql) or die($mysqli->error);
    }
  }
else
  {
  echo "Invalid file";
  }

}
?>