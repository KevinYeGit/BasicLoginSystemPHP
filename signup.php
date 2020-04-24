<?php
    require "header.php";
?>
<main>
    <div>
        <section>
            <h1>Signup</h1>
            <?php
                if(isset($_GET['error'])){
                   if($_GET['error'] == "uresform"){
                       echo '<p>Kérem töltse ki a mezőket!</p>';
                   }elseif($_GET['error'] == 'helytelenemail'){
                    echo '<p>Helytelen Email!</p>';
                   }elseif($_GET['error'] == 'helytelenfelhasznalonev'){
                    echo '<p>Helytelenfelhasználó név!</p>';
                   }elseif($_GET['error'] == 'jelszocheck'){
                    echo '<p>Jelszavak nem egyeznek</p>';
                   }
                   elseif($_GET['error'] == 'felhasznalonevfoglalt'){
                    echo '<p>Ez a felhasznaló név foglalt!</p>';
                   }
                }elseif($_GET["signup"] == "sikeres"){
                    echo '<p>Sikeres regisztráció!</p>';

                }
            ?>
            <form action="scripts/signup.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username">
                <input type="mail" name="mail" placeholder="E-mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </div>
</main>
<?php
    require "footer.php";
?>