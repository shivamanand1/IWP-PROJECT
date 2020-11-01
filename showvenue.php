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
</div>

<br><br><br><br><br><br>

<div style="position:absolute;left:10%;width:80%;">
<form action="" method="POST">
<input type="text" class="searchbox" placeholder="Search" name="s"><button type="submit" name="s0" class="sub1"><i class="fa fa-search"></i></button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<select name="price">
<option disabled selected>Sort by Price</option>
<option value="low">Low to High</option>
<option value="high">High to low</option>
</select><button type="submit" name="s1" class="sub1"><i class="fa fa-search"></i></button>
</form>
</div>
<br><br><br>


<?php


$conn = mysqli_connect('localhost','root','','eventmanagement');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['s0'])){
	$s=$_POST['s'];
	$sql = "select * from venue";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		$name=$row["venue_name"];
		$add=$row["address"];
		$cap=$row["capacity"];
		$cost=$row["cost"];
		$summary=$row["summary"];
		$imgd=$row["img"];
		$email=$row["email"];
		$a=stripos($name,$s);
		if(is_numeric($a)){
		?>
        <div style="width:80%;margin-left:10%;border:3px solid purple;border-radius:5px;background-color:white;padding:1%;" class="clearfix">
		<div>
		<img src="<?php echo $imgd;?>" width="20%" height="20%" style="float:left;"></img>
		</div>
		
		<div style="float:left;margin-left:3%;width:50%;text-align: justify;">
		<span style="font-weight:bold;font-size:30px"><?php echo $name;?></span><br>
		<span style="color:grey;"><?php echo $add;?></span><br>
		<span style="font-size:12px;"><?php echo $summary;?></span>
		</div>
		<div style="float:left;margin-left:5%;">
		<span style="font-weight:bold;font-size:15px">Maximum Capacity: </span><?php echo $cap;?><br>
		<span style="font-weight:bold;font-size:15px">Approx cost per person: </span><?php echo $cost;?><br>
		<span style="font-weight:bold;font-size:15px">Email: </span><?php echo $email;?><br><br>
		<a href="form1.php?vname=<?php echo $name; ?>"><input type="submit" value="Book Now" class="sub"></a>
		</div>
		</div>
		<br><br>
    <?php }
	}
} else {
    echo "0 results";
}
	
}


else if(isset($_POST['s1'])){
	$sb=$_POST['price'];
	if(strcmp($sb,"low")==0)
	$sql = "select * from venue order by cost";
	else
	$sql = "select * from venue order by cost DESC";
	
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		$name=$row["venue_name"];
		$add=$row["address"];
		$cap=$row["capacity"];
		$cost=$row["cost"];
		$summary=$row["summary"];
		$imgd=$row["img"];
		$email=$row["email"];
		?>
        <div style="width:80%;margin-left:10%;border:3px solid purple;border-radius:5px;background-color:white;padding:1%;" class="clearfix">
		<div>
		<img src="<?php echo $imgd;?>" width="20%" height="20%" style="float:left;"></img>
		</div>
		
		<div style="float:left;margin-left:3%;width:50%;text-align: justify;">
		<span style="font-weight:bold;font-size:30px"><?php echo $name;?></span><br>
		<span style="color:grey;"><?php echo $add;?></span><br>
		<span style="font-size:12px;"><?php echo $summary;?></span>
		</div>
		<div style="float:left;margin-left:5%;">
		<span style="font-weight:bold;font-size:15px">Maximum Capacity: </span><?php echo $cap;?><br>
		<span style="font-weight:bold;font-size:15px">Approx cost per person: </span><?php echo $cost;?><br>
		<span style="font-weight:bold;font-size:15px">Email: </span><?php echo $email;?><br><br>
		<a href="form1.php?vname=<?php echo $name; ?>"><input type="submit" value="Book Now" class="sub"></a>
		</div>
		</div>
		<br><br>
    <?php }
} else {
    echo "0 results";
}
	
	
	
	
}


else{
$sql = "select * from venue";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		$name=$row["venue_name"];
		$add=$row["address"];
		$cap=$row["capacity"];
		$cost=$row["cost"];
		$summary=$row["summary"];
		$imgd=$row["img"];
		$email=$row["email"];
		?>
        <div style="width:80%;margin-left:10%;border:3px solid purple;border-radius:5px;background-color:white;padding:1%;" class="clearfix">
		<div>
		<img src="<?php echo $imgd;?>" width="20%" height="20%" style="float:left;"></img>
		</div>
		
		<div style="float:left;margin-left:3%;width:50%;text-align: justify;">
		<span style="font-weight:bold;font-size:30px"><?php echo $name;?></span><br>
		<span style="color:grey;"><?php echo $add;?></span><br>
		<span style="font-size:12px;"><?php echo $summary;?></span>
		</div>
		<div style="float:left;margin-left:5%;">
		<span style="font-weight:bold;font-size:15px">Maximum Capacity: </span><?php echo $cap;?><br>
		<span style="font-weight:bold;font-size:15px">Approx cost per person: </span><?php echo $cost;?><br>
		<span style="font-weight:bold;font-size:15px">Email: </span><?php echo $email;?><br><br>
		<a href="form1.php?vname=<?php echo $name; ?>"><input type="submit" value="Book Now" class="sub"></a>
		</div>
		</div>
		<br><br>
    <?php }
} else {
    echo "0 results";
}
}

mysqli_close($conn);
?>
</body>
</html>