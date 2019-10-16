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

    <?php
/*		$query = "select * from builder";
				//echo $query;
                $query_run = mysqli_query($con,$query);
  */              $query1 = usp_ConvertQuery2HTMLTable('SELECT Builder_id, Builder_name FROM builder_database.builder');
                $query_run = mysqli_query($con,$query1);
                /*while($row = mysqli_fetch_array($query_run)) {
                    echo $row['Builder_id'];
                    echo $row['Builder_name'];
                }*/

                CREATE PROC builder_database.usp_ConvertQuery2HTMLTable (@SQLQuery NVARCHAR(3000))
                AS
                BEGIN
                DECLARE @columnslist NVARCHAR (1000) = ''
                DECLARE @restOfQuery NVARCHAR (2000) = ''
                DECLARE @DynTSQL NVARCHAR (3000)
                DECLARE @FROMPOS INT

                SET NOCOUNT ON

                SELECT @columnslist += 'ISNULL (' + NAME + ',' + '''' + ' ' + '''' + ')' + ','
                FROM sys.dm_exec_describe_first_result_set(@SQLQuery, NULL, 0)

                SET @columnslist = left (@columnslist, Len (@columnslist) - 1)
                SET @FROMPOS = CHARINDEX ('FROM', @SQLQuery, 1)
                SET @restOfQuery = SUBSTRING(@SQLQuery, @FROMPOS, LEN(@SQLQuery) - @FROMPOS + 1)
                SET @columnslist = Replace (@columnslist, '),', ') as TD,')
                SET @columnslist += ' as TD'
                SET @DynTSQL = CONCAT (
                        'SELECT (SELECT '
                        , @columnslist
                        ,' '
                        , @restOfQuery
                        ,' FOR XML RAW (''TR''), ELEMENTS, TYPE) AS ''TBODY'''
                        ,' FOR XML PATH (''''), ROOT (''TABLE'')'
                        )

                EXEC (@DynTSQL)
                SET NOCOUNT OFF
                END
                GO;
				//echo mysql_num_rows($query_run);
				//if($query_run)
				//{
	/*				if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					
					header( "Location: homepage.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
            		}
		*/?>
    
</body>
</html>