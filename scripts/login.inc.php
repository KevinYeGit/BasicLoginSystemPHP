 <?php

 if(isset($_POST['login-submit'])){

    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=uresform&mauluid" .$mailuid);
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?; ";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)){
                $passwordChecker = password_verify($password, $row['pwdUsers']);
                if($passwordChecker == false){
                    header("Location: ../index.php?error=rosszjelszo");
                    exit();
                }
                elseif($passwordChecker == true){
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];

                    header("Location: ../index.php?login=sikeres");
                    exit();  
                }
                else{
                    header("Location: ../index.php?error=rosszjelszo");
                    exit();  
                }
            }
            else{
                header("Location: ../index.php?error=nincsenilyenfelhasznalo");
                exit();
            }
        }
    }
}
 else{
    header("Location: ../index.php");
    exit();
 }