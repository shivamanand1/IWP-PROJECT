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
<title>services</title>
<link rel="stylesheet" href="nav.css">
<style>

body{
margin:0;
padding:0;
font:family:Bell MT;
background-image:url("servicesbg.jpg");
background-size: cover;
}


.outer {
    
    width: 90%;
    height: 65%;
	top:20%;
	position:absolute;
	left:5%;
	
    
}

.one {

    width: 25%;
    height: 100%;
	float:left;
	border:3px solid white;
	background-color:#F3D250;
	padding:2%;
	text-align:justify;
	
}

.two {
	float:left;
    width: 25%;
    height: 100%;
	border:2px solid white;
	margin-left:6%;
	background-color:#90CCF4;
	padding:2%;
	text-align:justify;

	
}

.three{
	float:right;
    width: 25%;
    height: 100%;
	border:2px solid white;
	background-color:#F78888;
	padding:2%;
	text-align:justify;
}

.p1{
width:120px;
height:120px;

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

<div class="outer">
    <div class="one">
	<center><img src="a.png" class="p1"></center>
	<center><h3>CORPORATE EVENTS</h3></center><br>
	There are various events that your company or organisation will be expected to host. These events range from local conferences and seminars to annual reward nights to one-off employee gala dinners or staff parties. Let our team make sure your company’s reputation is positively reflected in the success of these events. You may also get in touch for tips on suppliers and venues!
	</div>
	
    <div class="two">
	<center><img src="b.png" class="p1"></center>
	<center><h3>WEDDINGS</h3></center><br>
	Your wedding shall be one of the most important milestones of your life. Let our professional team make your wishes come true. Our wish is to see you satisfied. Get in touch so we explain the different ways in which we can help. You may thanks us later!
	</div>
	
    <div class="three">
	<center><img src="c.png" class="p1"></center>
	<center><h3>SOCIAL EVENTS</h3></center><br>
	Social events vary greatly, but all aim at entertaining and ensuring that people spend a good time with good company. Most social events mark different milestones in our lives. You can add your event also and other people can get to know about that and we will be more than happy to help out in organising or helping in your own event. We can guarantee that the event will be a milestone in itself!
	</div>
</div>


</body>

</html>