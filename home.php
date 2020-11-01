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
<title>homepage</title>
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


body{
margin:0;
padding:0;`
font:family:Bell MT;
background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url("homebg.jpg");
background-size: cover;
}

.title{
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
}

.title h1{
font-size:50px;
color: white;
font-family:Bell MT;
}

.title h4{
font-size:20px;
color: white;
font-family:Courier New;
}

.button{
position:absolute;
top:75%;
left:50%;
transform:translate(-50%,-50%);
}

.btn{
border: 1px solid white;
padding: 10px 30px;
color: white;
text-decoration: none;
}

.btn:hover{
background-color:white;
color: black;
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
<body>

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

<div class="title"><center><h1>EVENT PLANNING + STYLING + MANAGING </h1></center>
<center><h4>WEDDINGS, BIRTHDAY PARTIES, CORPORATE EVENTS, PRODUCT LAUNCHES AND MUCH MORE<h4></center>
</div>

<div class="button">
<a href="showvenue.php" class="btn">Book now</a>
</div>

</body>
</html>


