<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
    <head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--<link rel="stylesheet" href="css/style.css">-->
        <title>Let's Build</title>
        <link href="css/style.css?v=1.0" rel="stylesheet" type="text/css">
    </head>
<body>
    <nav class="navbar navbar-light bg-light navbar-expand-lg fixed-top">
        <a href="homepage.php" class="navbar-brand">Lets Build</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
		</button>
            
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="navbar-item">
                    <a href="homepage.php" class="nav-link">Homepage</a>
                </li>
                
                <li class="navbar-item">
                    <a href="contact.php" class="nav-link">Contact</a>
                </li>
                <li>
                    <form action="index.php" method="post">
                        <button type="submit" class="btn btn-link navbar-btn navbar-link">Log off</button>
                    </form>
                </li>
        </div>
	</nav>
    
    <div>
		<h3> <br><br> </h3>
    </div>
   
    <div class="header">
        <center><h3>Welcome, <?php echo $_SESSION['username']; ?></h3></center>
        <center><h3>ID: <?php 
        $uname = $_SESSION['username'];
        $query = "select Builder_id from builder where Builder_name='$uname'";
        $query_run=mysqli_query($con,$query);
        $ans = mysqli_fetch_assoc($query_run);
        $id = $ans['Builder_id'];
        echo $id;
        ?></h3></center>
    </div>

    <div class="container" style="margin-top:100px">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Contarctor Details</h5>
                <p class="card-text">View all the contractors you are associated with.</p>
            </div>
            <div class="card-body">
                <a href="contractor_details.php" class="btn btn-primary" name="contractor_btn">View All</a>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:100px">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Projects</h5>
                <p class="card-text">Here's a detailed list of all your projects.</p>
            </div>
            <div class="card-body">
            <a href="projects.php" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:100px">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daily Schedule</h5>
                <p class="card-text">Here's all of your schedule.</p>
            </div>
            <div class="card-body">
            <a href="daily_schedule.php" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:100px">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Personal Schedule</h5>
                <p class="card-text">Here's a detailed list of all your personal schedules.</p>
            </div>
            <div class="card-body">
            <a href="personal_schedule.php" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:100px">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Expenditure</h5>
                <p class="card-text">All the financial details.</p>
            </div>
            <div class="card-body">
            <a href="expenditure.php" class="btn btn-primary" name="expe">View All</a>
            </div>
        </div>
    </div>

    

</body>
</html>