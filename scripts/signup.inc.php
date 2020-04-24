<?php

if(isset($_POST['signup-submit'])){

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRep = $_POST['pwd-repeat'];

if(empty($username) || empty($email) || empty($password) || empty($passwordRep)){

    header("Location: ../signup.php?error=uresform&uid=" .$username."&mail=".$email);
    //Elmenti azokat amiket beírt
    exit();
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
    header("Location: ../signup.php?error=helytelenemailesfelhasznalonev");
    exit();
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=helytelenemail&uid=" .$username);
    exit();
}
elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
    header("Location: ../signup.php?error=helytelenfelhasznalonev&mail=" .$email);
    exit();
}
elseif($password !== $passwordRep){
    header("Location: ../signup.php?error=jelszocheck&uid" .$username."&mail".$email);
    exit();
}
else{
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
  
    //azért nem $username-t használok h ne tudjanak a formban sql kodot futattatni
    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement,$sql)){
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement); 
        mysqli_stmt_store_result($statement);
        $resultChecker = mysqli_stmt_num_rows($statement);
        if($resultChecker > 0){
            header("Location: ../signup.php?error=felhasznalonevfoglalt");
            exit();
        }
        //megnézí hogy foglalt-e már a username

        else{
            $sql ="INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
            $statement =mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($statement,$sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else{
                //Jelszó hash
                $hash = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($statement, "sss", $username, $email, $hash);
                mysqli_stmt_execute($statement); 
                header("Location: ../signup.php?signup=sikeres");
                exit();
            }
            
        }
    }
}
mysqli_stmt_close($statement);
mysqli_close($conn);


}
else{
    header("Location: ../signup.php");
    exit();
}