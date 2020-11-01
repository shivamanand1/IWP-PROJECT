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
background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(bg2.jpg) no-repeat;
background-size:cover;

}

.outer {
    
    width: 60%;
    height: 40%;
	position:absolute;
	left:20%;


	
}

.one {

    width: 45%;
    height: 100%;
	float:left;
	background-color:white;
	border:2px solid grey;
	border-radius:10px;
	text-align:justify;
}

.two{
	width: 45%;
    height: 100%;
	float:right;
	background-color:white;
	border:2px solid grey;
	border-radius:10px;
	text-align:justify;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

.sub{
color:white;
padding:1px 3px;
border: 1px solid transparent;
transition: 0.6s ease;
text-decoration: none;
background-color:#F78888;
background-size:cover;
border-radius:8px;
width:40%;
height:30px;
font-size:15px;
float:right;
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

.sub2{
color:black;
border: 1px solid transparent;
transition: 0.6s ease;
text-decoration: none;
background-color:#F3D250;
height:27px;
border-radius: 3px;
width:11%;
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
.searchbox
{
	width:70%;
	height:29px;
	border-radius: 5px;
	border:2px solid grey;
	outline: none;
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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
</div><br><br><br><br><br><br>

<div style="position:absolute;left:10%;width:80%;">
<form action="" method="POST">
<input type="text" class="searchbox" placeholder="Search" name="s"><button type="submit" name="s0" class="sub1"><i class="fa fa-search"></i></button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<button type="submit" name="s1" class="sub2">Sort By Date <i class="fa fa-search"></i></button>
</form>
</div>
<br><br><br><br>


<?php


$conn = mysqli_connect('localhost','root','','eventmanagement');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['s0'])){
$sql = "select * from events";

$result = mysqli_query($conn, $sql);
$count=0;
$s=$_POST['s'];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		$name=$row["name"];
		$add=$row["location"];
		$cost=$row["price"];
		$date1=$row["date"];
		$type=$row["type"];
		$imgd=$row["img_dir"];
		$date2=strtotime($date1);
		$month=date("M",$date2);
		$date=date("d",$date2);
		$a=stripos($name,$s);
		if(is_numeric($a)){
		
		if(($count%2)==0)
		{
		?>
		<div class="outer">
        <div class="one">
		<img src="<?php echo $imgd;?>" width="100%" height="60%"></img><br>
		<table border="2" style="border:2px solid transparent;">
		<tr>
		<td width="30%" style="padding:7px;"><center><font color="red" size="5"><b><?php echo $date; ?></font><br><font size="5"><?php echo $month; ?></b></font></td>
		<td width="70%" style="padding:5px 0px 3px 3px;"><font size="4"><b><?php echo $name; ?></b></font><br>
		<font size="2" color="grey"><?php echo $add;?> <br> <?php echo $type; ?><br> <?php echo ("Rs ".$cost." onwards"); ?></font>
		&emsp;<a href="form2.php?ename=<?php echo $name; ?>"><input type="submit" value="Register" class="sub"></a><td>
		</tr>
		</table>
		
		</div>
    <?php 
	}
	else
	{
		?>
        <div class="two">
		<img src="<?php echo $imgd;?>" width="100%" height="60%"></img><br>
		<table border="2" style="border:2px solid transparent;">
		<tr>
		<td width="30%" style="padding:7px;"><center><font color="red" size="5"><b><?php echo $date; ?></font><br><font size="5"><?php echo $month; ?></b></font></td>
		<td width="70%" style="padding:5px 0px 3px 3px;"><font size="4"><b><?php echo $name; ?></b></font><br>
		<font size="2" color="grey"><?php echo $add;?> <br> <?php echo $type; ?><br> <?php echo ("Rs ".$cost." onwards"); ?></font>
		&emsp;<a href="form2.php?ename=<?php echo $name; ?>"><input type="submit" value="Register" class="sub"></a><td>
		</tr>
		</table>
		
		</div>
		</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<?php
	}
	$count++;
	}
}}
 else {
    echo "0 results";
}
}

else
{
if(isset($_POST['s1'])){
	$sql = "select * from events order by date";
}
else
{
	$sql = "select * from events";
}

$result = mysqli_query($conn, $sql);
$count=0;

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		$name=$row["name"];
		$add=$row["location"];
		$cost=$row["price"];
		$date1=$row["date"];
		$type=$row["type"];
		$imgd=$row["img_dir"];
		$date2=strtotime($date1);
		$month=date("M",$date2);
		$date=date("d",$date2);
		
		if(($count%2)==0)
		{
		?>
		<div class="outer">
        <div class="one">
		<img src="<?php echo $imgd;?>" width="100%" height="60%"></img><br>
		<table border="2" style="border:2px solid transparent;">
		<tr>
		<td width="30%" style="padding:7px;"><center><font color="red" size="5"><b><?php echo $date; ?></font><br><font size="5"><?php echo $month; ?></b></font></td>
		<td width="70%" style="padding:5px 0px 3px 3px;"><font size="4"><b><?php echo $name; ?></b></font><br>
		<font size="2" color="grey"><?php echo $add;?> <br> <?php echo $type; ?><br> <?php echo ("Rs ".$cost." onwards"); ?></font>
		&emsp;<a href="form2.php?ename=<?php echo $name; ?>"><input type="submit" value="Register" class="sub"></a><td>
		</tr>
		</table>
		
		</div>
    <?php 
	}
	else
	{
		?>
        <div class="two">
		<img src="<?php echo $imgd;?>" width="100%" height="60%"></img><br>
		<table border="2" style="border:2px solid transparent;">
		<tr>
		<td width="30%" style="padding:7px;"><center><font color="red" size="5"><b><?php echo $date; ?></font><br><font size="5"><?php echo $month; ?></b></font></td>
		<td width="70%" style="padding:5px 0px 3px 3px;"><font size="4"><b><?php echo $name; ?></b></font><br>
		<font size="2" color="grey"><?php echo $add;?> <br> <?php echo $type; ?><br> <?php echo ("Rs ".$cost." onwards"); ?></font>
		&emsp;<a href="form2.php?ename=<?php echo $name; ?>"><input type="submit" value="Register" class="sub"></a><td>
		</tr>
		</table>
		
		</div>
		</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<?php
	}
	$count++;
}}
 else {
    echo "0 results";
}
}




mysqli_close($conn);
?>
<br><br>.
</body>
</html>