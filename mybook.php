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
background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(bgbook.jpg) no-repeat;
background-size:cover;

}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

.sub{
color:white;
padding:5px 20px;
border: 1px solid transparent;
transition: 0.6s ease;
text-decoration: none;
background-color:#F78888;
background-size:cover;
border-radius:18px;
width:75%;
height:45px;
font-size:20px;
}

.sub1{
color:black;
border: 1px solid transparent;
transition: 0.6s ease;
text-decoration: none;
background-color:white;
height:27px;
border-radius: 3px;
width:30px;
}

.sub:hover{
background-color:#90CCF4;
color: black;
}

select{
border: none;
outline: none;
background-color: white;
color:black;
font-size: 18px;
font-weight:bold;
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

tr.bb td {
  border-bottom:3px solid black;
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
<br><br><br><br><br><br>
<div style="position:absolute;left:20%;">
<h2 style="color:white;">Venues booked</h2><br>
<table style="background-color:#90CCF4;color:black;width:120%;border-radius:4px;border:1px solid yellow;border-collapse:collapse;" cellpadding="20" cellspacing="20">
<tr style="border-bottom: 3px solid black;height:30px;">
<th>Name</th><th>Venue booked</th><th>number of People</th><th>Date</th><th>Occasion</th><th>Budget</th><th>Requirements</th>
</tr>
<?php


$conn = mysqli_connect('localhost','root','','eventmanagement');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$a=$_SESSION['uname'];
$sql = "select * from bookings where username='$a'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
			?>
			<tr style="height:30px;">
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['venue_name'];?></td>
			<td><?php echo $row['count'];?></td>
			<td><?php echo $row['date'];?></td>
			<td><?php echo $row['occasion'];?></td>
			<td><?php echo $row['budget'];?></td>
			<td><?php echo $row['requirements'];?></td>
			</tr>
			<?php
		 }
} 


mysqli_close($conn);
?>
</table>
</div>

<br><br><br><br><br><br><br><br><br>
<div style="position:absolute;left:20%;">
<h2 style="color:white;">Events Registered</h2><br>
<table style="background-color:#F78888;color:black;width:133%;border-radius:4px;border:1px solid yellow;border-collapse:collapse;" cellpadding="20" cellspacing="20">
<tr style="border-bottom: 3px solid black;height:30px;">
<th>Name</th><th>Event Registered</th><th>Number of tickets</th><th>Mobile Number</th><th>Email</th>
</tr>
<?php


$conn = mysqli_connect('localhost','root','','eventmanagement');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$a=$_SESSION['uname'];
$sql = "select * from eventbooking where username='$a'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
			?>
			<tr style="height:30px;">
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['event_name'];?></td>
			<td><?php echo $row['count'];?></td>
			<td><?php echo $row['Mobile_num'];?></td>
			<td><?php echo $row['email'];?></td>
			</tr>
			<?php
		 }
} 

mysqli_close($conn);
?>
</table>
</div>

</body>
</html>