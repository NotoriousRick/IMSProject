<?php
/* Include config file */
require_once 'Config_dbIMS.php';
/* Zonder de session_start-functie weet de applicatie niet wie je bent en werkt hij dus niet */
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    // controleer of er een user_id bekend is (in adres balk)
    if (isset($_GET['User_ID']))
    {
        $sql = "SELECT User_ID, UserName FROM User WHERE User_ID =" . $_GET['User_ID'];
        
        if (!$result = $link->query($sql))
        {
            //Query mislukt
        }

        if ($result->num_rows === 0)
        {
            print 'Geen gebruikers gevonden';
            exit;
        }

        $user = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // als er een user_id bekend is komen we in deze edit functie
    if (isset($_GET['User_ID']))
    {
        $username = $_POST['UserName'];
        
        if ($_POST['Password'] !== 'niet het wachtwoord')
        {
            $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        }

        $sql = "UPDATE User SET UserName = '$username'";
        if (isset($password))
        {
            $sgl = $sql.", PasswordHash = '$password'";
        }
        $sql = $sql.",WHERE User_ID =" . $_GET['User_ID'];

        if ($link->query($sql) === true)
        {
            //Query gelukt
            header('Location: UserOverzicht.php');
        }
        else
        {
            print $link->error;
        }
    }
    else // als er geen user_id bekend is komen we in deze create user functie
    {

        $username = $_POST['UserName'];
        $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO User (UserName, PasswordHash) Values ('$username', '$password')";
        if ($link->query($sql) === true)
        {
            //Query gelukt
            header('Location: UserOverzicht.php');
        }
        else
        {
            print $link->error;
        }
    }
    $link->close();
}

if (isset($_SESSION['user']))
{
    print 'Welkom ' . $_SESSION['user'];
}
else
{
    print 'Niet aangemeld';
    /*Redirect to login page*/
    header('Location: login.php');
    exit;
}
?>

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
                <input type="text" name="UserName" value="<?php if (isset($user)) print $user['UserName']; ?>" required/><br><br>
                <label>Wachtwoord: </label><br>
                <input type="password" name="Password" value="<?php if (isset($user)) print 'niet het wachtwoord' ?>" required/><br><br>
                <input type="submit" value="opslaan">
            </DIV>
        </FORM>
    </BODY>
</HTML>