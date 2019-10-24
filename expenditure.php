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
            <button class="btn btn-default dropdown-toggle" type="button" id="strikes-range" data-toggle="dropdown" aria-haspopup="true"> Add Contractors <span class="caret"></span> </button>
                <ul class="dropdown-menu" aria-labelledby="strikes">
                    <li style="width: 280px;">
            		    <form action="contractor_details.php" method="post">
			                <div class="class-for-form">
				                <label><b>Total Amount</b></label>
                                <input type="text" class="input-class" placeholder="Enter contractor name" name="tot_amt" required>
                                <label><b>Amount Received</b></label>
                                <input type="number" class="input-class" placeholder="Enter contractor Phone number" name="amt_rec" required>
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
                
                $cont_name = $_POST['cont_name'];
				$query = "select * from contractor where Builder_id='$id' and Contractor_name='$cont_name'";
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
                        $query = "insert into contractor (Contractor_id,Contractor_name,Builder_id,PhoneNum) values('','". $_POST["cont_name"] . "','$id','" . $_POST["phone"] . "')";
                        $query_run = mysqli_query($con,$query);
                        if($query_run)
                        {
                            echo '<script type="text/javascript">alert("Contractor Registered.. Welcome")</script>';
                            header( "Location: contractor_details.php");
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
    <div id="push"></div>
    
    <div class="container" style="margin-top:30px">
        <table class="table table-striped table-dark table-bordered text-center">
        <thead>
            <tr>
                <th>Contratcor ID</th>
                <th>Contractor Name</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
                
                $sql = "SELECT * FROM builder";
                $query_run = mysqli_query($con,$sql);

                $uname = $_SESSION['username'];
                $query = "select Builder_id from builder where Builder_name='$uname'";
                $query_run=mysqli_query($con,$query);
                $ans = mysqli_fetch_assoc($query_run);
                $id = $ans['Builder_id'];

                $query = "select * from contractor where Builder_id='$id'";
                $query_run = mysqli_query($con,$query);
            
                if(mysqli_num_rows($query_run)>0) {
                    // output data of each rows
                    while($row = $query_run->fetch_assoc()) {
                        echo "<tr><td>" . $row["Contractor_id"]. "</td><td>" . $row["Contractor_name"] . "</td><td>"
                        . $row["PhoneNum"]. "</td></tr>";
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


DELIMITER $$
CREATE PROCEDURE SUB (REC INT(9), SPENT INT(9)) RETURNS INT(8)
BEGIN
    DECLARE PROFIT INT(8);
    SET PROFIT = REC - SPENT;
    RETURN PROFIT;
END $$
DELIMITER ;

profit = CALL SUB($tot_amt, $rec_amt)

if(profit < 0) 




CREATE TRIGGER trigger_Name
Before insert ON 
For  EACH  ROW
