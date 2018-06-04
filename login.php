hello there, this is just an empty page (for now)<br><br>

echo "no really, there is nothing here, go away<br>

<a href="http://localhost/IMS">Click here to get dissapointed</a>

<?php
/* Include config file */
//require_once 'Config_dbIMS.php';
/* Zonder de session_start-functie weet de applicatie niet wie je bent en werkt hij dus niet */
session_start();

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//
//    $username = $_POST['UserName'];
//    $password = $_POST['Password'];
//
//    $sql = "SELECT * FROM User WHERE Username = '$username'";
//    if (!$result = $link->query($sql)) {
//        //Query mislukt
//    }
//
//    if ($result->num_rows === 0) {
//        print 'Gebruiker niet gevonden';
//        exit;
//    }
//
//    $user = $result->fetch_assoc();
//
//    if (password_verify($password, $user['PasswordHash'])) {
//        print 'aanmelden gelukt <br />';
//
//        $_SESSION['user'] = $user['UserName'];
//    } else {
//        print 'aanmelden mislukt!';
//    }
//    $result->free();
//    $link->close();
//}
//
//if (isset($_SESSION['user']))
//{
//    print 'Welkom '. $_SESSION['user'];
//}
//else
//{
//    print 'Niet aangemeld';
////    header('Location: login.php');
////    exit;
//}
//
//?>
<HTML>
    <HEAD>
        <META charset="uft-8">
        <TITLE></TITLE>
        <! --
        linkjes/scripts voor css, boodstrap, javascript, jquery etc etc
        -->
    </HEAD>
    <BODY>
        <FORM method="post">
            <DIV>
                <label>Gebruikersnaam: </label><br>
                <input type="text" name="UserName" required/><br><br>
                <label>Wachtwoord: </label><br>
                <input type="password" name="Password" required/><br><br>
                <input type="submit" value="inloggen">
            </DIV>
        </FORM>
    </BODY>
</HTML>