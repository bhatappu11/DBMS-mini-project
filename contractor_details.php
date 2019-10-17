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
        <a href="#" class="navbar-brand">Lets Build</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
		</button>
            
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="navbar-item">
                    <a href="#" class="nav-link">Homepage</a>
                </li>
                <li class="navbar-item">
                    <a href="#" class="nav-link">About Me</a>
                </li>
                <li class="navbar-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li>
                    <form action="index.php" method="post">
                        <button type="submit" class="btn btn-link navbar-btn navbar-link">Log off</button>
                    </form>
                </li>
                <!--<li class="navbar-item">
                    <a href="index.php" class="logout_button">Logout</a>
                </li> -->
            </ul>
        </div>
	</nav>
    
    <div>
		<h3> <br><br> </h3>
    </div>
    <div class="container" style="margin-top:30px">
        <table class="table table-striped table-dark table-bordered text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
                
                $sql = "SELECT * FROM builder";
                $query_run = mysqli_query($con,$sql);
        
            
                if(mysqli_num_rows($query_run)>0) {
                    // output data of each row
                    while($row = $query_run->fetch_assoc()) {
                        echo "<tr><td>" . $row["Builder_id"]. "</td><td>" . $row["Builder_name"] . "</td><td>"
                        . $row["password"]. "</td></tr>";
                    }
                    echo "</table>";
                } else { echo "0 results"; } 
            ?>
        </tbody>
        </table>
    </div>
    <!--<div id="main-wrapper">
    <center><h2>Add Contractors</h2></center>
    <form action="contractor_details.php" method="post">
        <div class="form-group">
            <label for="contractor_name">Contractor Name:</label>
            <input type="contractor_name" class="form-control" id="contractor_name">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="phone" class="form-control" id="phone">
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> -->
    <!--<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Add contractors
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
  <form action="contractor_details.php" method="post">
        <div class="form-group">
            <label for="contractor_name">Contractor Name:</label>
            <input type="contractor_name" class="form-control" id="contractor_name">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="phone" class="form-control" id="phone">
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Add contractors <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <form>
       <div class="form-group">
       <label for="contractor_name">Contractor Name:</label>
         <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
       </div>
       <div class="form-group">
       <label for="phone">Phone Number:</label>
         <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
       </div>
       <div class="form-group">
         <button type="submit" class="btn btn-default">Sign in</button>
       </div>
    </form>
  </ul>
</div>-->


<form class="dropdown-menu p-4">
  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
  </div>
  <div class="form-group">
    <label for="exampleDropdownFormPassword2">Password</label>
    <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="dropdownCheck2">
    <label class="form-check-label" for="dropdownCheck2">
      Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</body>
</html>





<!--

<div class="btn-group dropright">
  <button type="button" class="btn btn-secondary">
    Split dropright
  </button>
  <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropright</span>
  </button>
  <div class="dropdown-menu">
    <!-- Dropdown menu links 
  </div>
</div>-->