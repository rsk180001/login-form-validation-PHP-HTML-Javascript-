<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('location:login.html');
    exit();
}
 ?>
<!DOCTYPE html >
<html >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Home Page</title>
    <script language="javascript" type="text/javascript">
    function logout()
    {
        <?php session_destroy(); ?>   
    }
    </script>
  </head>
 
  <body>
    <img src= <?php echo $_SESSION['avatar']; ?> ></img>
	 <h2>Welcome <?php echo $_SESSION['fullname']; ?></h2>
	 <h3>Favourite Books : <?php echo $_SESSION['booktitle']; ?></h3>
    <?php echo "<br> <a href='login.html'>  <button onClick= \"logout()\"> Logout </button></a>"; ?>   
    
  </body>
</html>