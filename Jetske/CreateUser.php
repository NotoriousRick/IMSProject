<?php
/* Include config file */
require_once 'Config_dbIMS.php';
/* Zonder de session_start-functie weet de applicatie niet wie je bent en werkt hij dus niet */
session_start();

//controleer of de user een admin is
if (isset($_SESSION['user']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1)
{
    print 'Welkom ' . $_SESSION['user'] . "<br /><br />";
}
else //geen admin = geen toegang tot Creat(/update/delete)User pagina
{
    /* Redirect to login page */
    header('Location: login.php'); // deze location moet nog veranderd worden in de indexpagina van Vlad
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    // controleer of er een user_id bekend is (in adres balk)
    if (isset($_GET['User_ID']))
    {
        $sql = "SELECT User_ID, UserName, IsAdmin FROM User WHERE User_ID = ?";

        $stmt = $link->prepare($sql);
        $stmt->bind_Param("i", $_GET['User_ID']);

        //is de $sql query gelukt of niet
        if ($stmt->execute() == false)
        {
            //Query mislukt
            print 'Oops er is iets misgegaan.';
            exit;
        }

        //Data ophalen
        $result = $stmt->get_result();

        //de ingevoerde username bestaat niet er worden dus 0 records gevonden
        if ($result->num_rows === 0)
        {
            print 'Geen gebruikers gevonden.';
            exit;
        }

        $user = $result->fetch_assoc();
    }
    elseif (isset($_GET['Delete_ID']))
    {
        $sql = "DELETE FROM User WHERE User_ID = ?";

        $stmt = $link->prepare($sql);
        $stmt->bind_Param("i", $_GET['Delete_ID']);

        //is de $sql query gelukt of niet
        if ($stmt->execute() == false)
        {
            //Query mislukt
            print 'Oops, er is iets misgegaan.';
            exit;
        }
        header('Location: UserOverzicht.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['UserName'];
    $pwd = $_POST['Password'];
    $PwdFouten = "";

    //in deze sring lengte if-statement controleren we server side of er een username is gezet/ingevuld
    if (strlen($username) === 0)
    {
        $GeenUsername = true;
    }

    //in deze string lengte if-statement controleren we server side of het password aan de eis voldoet
    if (strlen($pwd) <= 8)
    {
        $GeenPassword = true;
        $PwdFouten = "Minstens 8 karakters";
    }

    //in de onderstaande 4 preg_match if-statements controleren we server side of het password aan die 4 eisen voldoet
    if (preg_match("([!,%,&,@,#,$,^,*,?,_,~])", $pwd) === 0)
    {
        $GeenPassword = true;
        $PwdFouten = $PwdFouten . "<br>" . "Uw invoer dient minimaal 1 speciaal teken te bevaten";
    }

    if (preg_match("([a-z])", $pwd) === 0)
    {
        $GeenPassword = true;
        $PwdFouten = $PwdFouten . "<br>" . "Uw invoer dient minimaal 1 kleine letter";
    }
    
    if (preg_match("([A-Z])", $pwd) === 0)
    {
        $GeenPassword = true;
        $PwdFouten = $PwdFouten . "<br>" . "Uw invoer dient minimaal 1 hoofdletter";
    }
    
    if (preg_match("([0-9])", $pwd) === 0)
    {
        $GeenPassword = true;
        $PwdFouten = $PwdFouten . "<br>" . "Uw invoer dient minimaal 1 getal";
    }


    if (!isset($GeenUsername) && !isset($GeenPassword))
    {
        //als er een user_id bekend is komen we in deze edit/update functie en vullen we dat bij behorende username alvast in
        if (isset($_GET['User_ID']))
        {
            $isadmin = isset($_POST['IsAdmin']) ? true : false;

            //als er geen nieuw wachtwoord wordt ingesteld dan blijft het oude wachtwoord in de database staan 
            if ($_POST['Password'] !== 'niet het wachtwoord')
            {
                $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
            }

            $sql = "UPDATE User SET UserName = ?, IsAdmin = ?";
            //als er wel een nieuw wachtwoord wordt ingesteld dan wordt de passwordhash geupdate
            if (isset($password))
            {
                $sql = $sql . ", PasswordHash = ?";
            }
            $sql = $sql . " WHERE User_ID = ?";

            $stmt = $link->prepare($sql);

            //als er wel een nieuw wachtwoord wordt ingesteld dan wordt de passwordhash geupdate
            if (isset($password))
            {
                $stmt->bind_param("sisi", $username, $isadmin, $password, $_GET['User_ID']);
            }
            else //als er geen nieuw wachtwoord wordt ingesteld
            {
                $stmt->bind_param("sii", $username, $isadmin, $_GET['User_ID']);
            }

            print($sql);

            //is de $sql query voor het updaten gelukt of niet
            if ($stmt->execute() === true)
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
            $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO User (UserName, PasswordHash) Values (?, ?)";

            $stmt = $link->prepare($sql);
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute())
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
}
?>

<html>
    <head>
        <meta charset="uft-8">
        <title></title>
        <link rel="stylesheet" href="../Style/bootstrap.min.css">
    </head>
    <body>

        <form method="post">
            <div>
                <label>Gebruikersnaam: </label><br>
                <input type="text" name="UserName" value="<?php if (isset($user)) print $user['UserName']; ?>" required/><br><br>
                <?php if (isset($GeenUsername)) print '<span style="color:red">Voer alstublieft een username in.</span><br>'; ?>
                <label>Wachtwoord: </label><br>
                <input type="password" name="Password" value="<?php if (isset($user)) print 'niet het wachtwoord' ?>" required/><br><br>
                <?php if (isset($GeenPassword)) print '<span style="color:red">' . $PwdFouten . '</span><br>'; ?>
                <label>Is Admin?</label>
                <input type="checkbox" name="IsAdmin" <?php if (isset($user) && $user['IsAdmin'] == 1) print 'checked="true"' ?>/>
                <input type="submit" value="opslaan">
                <a href="UserOverzicht.php">annuleren</a>
            </div>
        </form>
    </body>
    <!--Main jQuery library-->
    <script src="../Scripts/jquery-3.3.1.slim.js"></script>

    <!--Popper.js plugin for bootstrap-->
    <script src="../Scripts/popper.js"></script>

    <!--Bootstrap script library-->
    <script src="../Scripts/bootstrap.min.js"></script>

    <!--Jetske's special script-->
    <script src="../Scripts/PassRequirements.js"></script>
    
    
    <script>
        $(document).ready(function()
        {
            $( ":password" ).PassRequirements();
        });
    </script>
</html>
