
<html>
<head>
<title>Log in</title>
<link rel="stylesheet" href="nav.css">
<style>
body{
margin:0;
padding:0;
font:family:Bell MT;
background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(loginbg.jpg) no-repeat;
background-size: cover;
}

.lb{
width: 280px;
position: absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
color: white;
padding: 30px;
}

.lb h1{
float: left;
font-size: 40px;
border-bottom: 4px solid white;
margin-bottom: 50px;
padding: 13px 0;
}

.textbox{
width: 100%;
overflow: hidden;
font-size: 20px;
padding: 8px 0;
margin: 8px 0;
border-bottom: 1px solid;
}

.textbox input{
border: none;
outline: none;
background: none;
color: white;
font-size: 18px;
width: 80%;
float:left;
margin:0 10px; 
}

.btn{
width:100%;
background:none;
border: 2px solid white;
color:white;
padding: 5px;
font-size: 18px;
cursor: pointer;
margin:12px 0;
}

.btn:hover{
background-color:white;
color: black;
transition: 0.6s ease;
}

.btn{
width:100%;
background:none;
border: 2px solid white;
color:white;
padding: 5px;
font-size: 18px;
cursor: pointer;
margin:12px 0;
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

<form action="" method="POST">
<div class="lb">
<h1>Login</h1>

<div class="textbox">
<input type="text" placeholder="Username" name="uname">
</div>

<div class="textbox">
<input type="password" placeholder="Password" name="pass">
</div>

<input class="btn" type="submit" name="s1" value="Sign in"><br><br><br>
<center><span class="nc">Don't have an account?</span></center>
<input class="btn" type="submit" name="s2" value="Sign up">
</div>
</form>
</body>
</html>


<?php


session_start();

if(isset($_POST['s1']) && isset($_POST['uname']) && isset($_POST['pass']))
{
	
$uname=$_POST['uname'];
$pass=$_POST['pass'];

echo $uname;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventmanagement";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "select * from signup where username='$uname' and password='$pass'";

if(mysqli_num_rows(mysqli_query($conn,$sql1))==0)
{
		echo '<script type="text/javascript">alert("Invalid username or password");</script>';	
		exit();
}
else{
	$_SESSION['uname']=$uname;
	header("Location:home.php");
}


mysqli_close($conn);
}

if(isset($_POST['s2']))
	header("Location:signup.php");
?>
