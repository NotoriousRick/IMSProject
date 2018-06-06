<?php
/* Include config file */
require_once 'Config_dbIMS.php';
/* Zonder de session_start-functie weet de applicatie niet wie je bent en werkt hij dus niet */
session_start();

if (isset($_SESSION['user']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1)
{
    print 'Welkom ' . $_SESSION['user'] . "<br /><br />";
}
else //geen admin = geen toegang tot UserOverzicht pagina
{
    /* Redirect to login page */
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
        <?php
        $sql = "SELECT User_ID, UserName, IsAdmin FROM User";
        if (!$result = $link->query($sql))
        {
            //Query mislukt
        }

        if ($result->num_rows === 0)
        {
            print 'Geen gebruikers gevonden';
            exit;
        }

        print "<TABLE border='1'><TR><TH>Username</TH><TH>Is Administrator</TH><TH>Acties</TH></TR>";
        while ($user = $result->fetch_assoc())
        {
            print "<TR>" . "<TD>" . $user['UserName'] . "</TD>" . "<TD>" . $user['IsAdmin'] . "</TD>" . "<TD>" . "<a href='CreateUser.php?User_ID=" . $user['User_ID'] . "'><IMG src='user-edit-icon.png' alt='edit user' width='50px'/></a>" . "<a href='CreateUser.php'><IMG src='trash-bin-icon.png' alt='delete user' width='50px'/></a>" . "</TD>" . "</TR>";
        }


        print "</TABLE>";

        $result->free();
        $link->close();
        ?>
        <a href="CreateUser.php">Nieuwe gebruiker</a>
    </BODY> 
</HTML>