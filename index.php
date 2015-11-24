<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "code_louisville";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>TODO</title>

        <!-- Style sheets -->
        <link href='css/style.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <!-- JavaScript   -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h1>To Do.</h1>
        </div>
        <div class="container">
            <div class="row col-lg-5 col-lg-offset-4">
                <ul>
                <?php
                    $sql = "SELECT id, task FROM todo";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0)
                    {
                        // output data of each row
                        while($row = $result->fetch_assoc())
                        {
                            echo '<li class="task">';
                            echo "<span><a href='delete.php?id=".$row['id']."'>Done!</a></span>";
                            echo '<p>' . $row['task'] . '</p>';
                            echo '</li>';
                        }
                    }

                    else
                    {
                        echo "0 results";
                    }
                ?>
                </ul>

                <?php
                // Only process the form if $_POST isn't empty
                if ( ! empty( $_POST ) )
                {

                    // Connect to MySQL
                    $mysqli = new mysqli( 'localhost', 'root', 'root', 'code_louisville' );

                    // Check our connection
                    if ( $mysqli->connect_error )
                    {
                        die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
                    }

                    // Insert our data
                    $sql = "INSERT INTO todo ( task ) VALUE ('{$mysqli->real_escape_string($_POST['task']) }')";

                    $insert = $mysqli->query($sql);


                    // Close our connection
                    $mysqli->close();
                }
                ?>

                <form method="post" action="">
                    <input name="task" type="text">
                </form>
            </div>
        </div>
    </body>

</html>
<?php
$conn->close();
?>