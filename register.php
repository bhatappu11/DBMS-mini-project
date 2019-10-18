<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Lets Build</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-light bg-light navbar-expand-lg fixed-top">
            <a href="#" class="navbar-brand">Lets Build</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                   <li class="navbar-item">
                        <a href="aboutUs" class="nav-link">About Us</a>
                    </li>
                    <li class="navbar-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
	<div id="main-wrapper">
	<center><h2>Sign Up Form</h2></center>
		<form action="register.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/avatar.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter name" name="username" required>
				<label><b>Phone Number</b></label>
				<input type="number" placeholder="Enter Phone number" name="phone" required>
				<label><b>Address</b></label>
				<input type="text" placeholder="Enter Address" name="address" required>
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter password" name="password" required>
				<button name="register" class="sign_up_btn" type="submit">Sign Up</button>
				
				<center><a href="index.php"><button type="button" class="back_btn"><< Back to Login</button></a></center>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				@$username=$_POST['username'];
				@$phone=$_POST['phone'];
				@$address=$_POST['address'];
				@$password=$_POST['password'];
				
				$query = "select * from builder where Builder_name='$username'";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
						}
						else
						{
							$query = "insert into builder values('','$username','$address','$phone','$password')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								header( "Location: homepage.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				
			}
			else
			{
			}
		?>
	</div>
</body>
</html>