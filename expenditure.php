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
            </ul>
        </div>
	</nav>
    
    <div>
		<h3> <br><br> </h3>
    </div>

    <div class="form-inline">
        <div class="form-group">
            <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="strikes-range" data-toggle="dropdown" aria-haspopup="true"> Add Expenses <span class="caret"></span> </button>
                <ul class="dropdown-menu" aria-labelledby="strikes">
                    <li style="width: 280px;">
            		    <form action="expenditure.php" method="post">
			                <div class="class-for-form">
                                <label><b>Project ID</b></label>
                                <input type="number" class="input-class" placeholder="Enter project ID" name="proj_id" required>
                                <label><b>Total Amount</b></label>
                                <input type="text" class="input-class" placeholder="Enter amount received" name="tot_amt" required>
                                <label><b>Amount Spent</b></label>
                                <input type="number" class="input-class" placeholder="Enter amount spent on the project" name="amt_spe" required>
                                <button name="add_expense" class="btn-submit" type="submit">Add</button>
				            </div>
		                </form>
                    </li>
                </ul>
            </div>
        </div>                  
		
		<?php
			if(isset($_POST['add_expense']))
			{
                $username=$_SESSION['username'];
                $query = "select Builder_id from builder where Builder_name='$username'";
                $query_run=mysqli_query($con,$query);
                $ans = mysqli_fetch_assoc($query_run);
                $id = $ans['Builder_id'];
                
                $proj_id = $_POST['proj_id'];
                $tot_amt = $_POST['tot_amt'];
                $amt_spe = $_POST['amt_spe'];

                $q = "select Project_id from projects where Builder_id = '$id'";
                $q_run = mysqli_query($con,$q);
                if(){
                $query = "insert into expenditure (Project_id, Total_amount, Amount_spent) values ('". $_POST['proj_id'] ."', '". $_POST['tot_amt'] ."', '". $_POST['amt_spe'] ."')";
                $query_run = mysqli_query($con,$query);
                if($query_run)
                {
                    $sql = "DELIMITER $$
                            DROP PROCEDURE IF EXISTS `pro`$$
                            CREATE PROCEDURE `pro`(id int)
                            BEGIN
                            UPDATE expenditure SET Profit = (Total_amount-Amount_spent);
                            END
                            $$
                            DELIMITER ;";
                    $sql_run = mysqli_query($con,$sql);
                    $call = mysqli_prepare($con,"CALL pro(@proj_id)");
                    mysqli_stmt_execute($call);

                    echo '<script type="text/javascript">alert("Added to expenses... ")</script>';
                    header( "Location: expenditure.php");
                }
                else
                {
                    echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                }
            }
        }
        else{
            echo "Not your project";
        }
			else
			{
			}
		?>
	</div>
    <div id="push"></div>
    
    <div class="container" style="margin-top:30px">
        <table class="table table-striped table-dark table-bordered text-center">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Amount Received</th>
                <th>Amount Spent</th>
                <th>Profit</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $uname = $_SESSION['username'];
                $query = "select Builder_id from builder where Builder_name='$uname'";
                $query_run=mysqli_query($con,$query);
                $ans = mysqli_fetch_assoc($query_run);
                $id = $ans['Builder_id'];

                $query = "select * from expenditure where Project_id in (select project_id from projects where Builder_id='$id')";
                $query_run = mysqli_query($con,$query);
            
                if(mysqli_num_rows($query_run)>0) {
                    // output data of each rows
                    while($row = $query_run->fetch_assoc()) {
                        echo "<tr><td>" . $row["Project_id"] . "</td><td>" . $row["Total_amount"] . "</td><td>" . $row["Amount_spent"] . "</td></tr>" . $row["Profit"] . "</td></tr>";
                    }
                    echo "</table>";
                } else { echo "0 results"; }
            ?>
        </tbody>
        </table>
    </div>
	



    <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>