<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<header>
 <nav>
    <ul>
        <li><a href="">Főoldal</a></li>
        <li><a href="">Regisztráció</a></li>
        <li><a href="">Bejelentkezés</a></li>
        <li><a href="">Extra</a></li>
    </ul>

    <div>
        <?php
               if(isset($_SESSION['userId'])){
                echo  '<form action="scripts/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>';
              }else{
                  echo  '   <form action="scripts/login.inc.php" method="post">
                  <input type="text" name="mailuid" placeholder="Username">
                  <input type="password" name="pwd" placeholder="Password">
                  <button type="submit" name="login-submit">Login</button>
              </form>
              <a href="signup.php">Sign Up</a>';
              }
        ?>
 

    </div>
 </nav>
</header>

</body>
</html> 