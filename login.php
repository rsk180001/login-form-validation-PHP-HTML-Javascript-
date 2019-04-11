 <?php
 session_start();
$con = new mysqli('localhost', 'root', '', "pw5");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);

		$myusername = mysqli_real_escape_string($con,$username);
		$mypassword = mysqli_real_escape_string($con,$password);  
		if( $myusername == "" || $mypassword == "")
        {
            header('location:login.html');
            exit();
        }
        else
        {
            $sql = "SELECT users.password FROM users where users.username = '$myusername'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            if(password_verify($mypassword ,$row['password']))
            { 
                $sql = "SELECT users.fullname, users.avatar, favoritebooks.booktitle FROM 
                        users inner join favoritebooks on users.username = favoritebooks.username 
                        and users.username = '$myusername'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
                $count = mysqli_num_rows($result);
        
                if($count == 1) 
                {
                    $_SESSION['username'] = $myusername;
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['avatar'] = $row['avatar'];
                    $_SESSION['booktitle'] = $row['booktitle'];
                    header("location: welcome.php");
                }
            }
        }
 }

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

 ?>