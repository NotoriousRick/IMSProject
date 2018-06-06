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
            print 'Query mislukt';
            exit;
        }

        //Data ophalen
        $result = $stmt->get_result();

        //de ingevoerde username bestaat niet er worden dus 0 records gevonden
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
    //als er een user_id bekend is komen we in deze edit/update functie en vullen we dat bij behorende username alvast in
    if (isset($_GET['User_ID']))
    {
        $username = $_POST['UserName'];
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

        $username = $_POST['UserName'];
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
?>

<HTML>
    <HEAD>
        <META charset="uft-8">
        <TITLE></TITLE>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
        <script src="js/passRequirements.js"></script>
    </HEAD>
    <BODY>
        <script>
            $(document).ready(function()
            {
               $( ":password" ).PassRequirements(); 
            });
        </script>
        <FORM method="post">
            <DIV>
                <label>Gebruikersnaam: </label><br>
                <input type="text" name="UserName" value="<?php if (isset($user)) print $user['UserName']; ?>" required/><br><br>
                <label>Wachtwoord: </label><br>
                <input type="password" name="Password" value="<?php if (isset($user)) print 'niet het wachtwoord' ?>" required/><br><br>
                <label>Is Admin?</label>
                <input type="checkbox" name="IsAdmin" <?php if (isset($user) && $user['IsAdmin'] == 1) print 'checked="true"' ?>/>
                <input type="submit" value="opslaan">
            </DIV>
        </FORM>
    </BODY>
</HTML>