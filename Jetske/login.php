<?php
/* Include config file */
require_once 'Config_dbIMS.php';
/* Zonder de session_start-functie weet de applicatie niet wie je bent en werkt hij dus niet */
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //username & password uit de post halen
    $username = $_POST['UserName'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM User WHERE Username = ?";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $username);

    //is de $sql query gelukt of niet
    if ($stmt->execute() == false)
    {
        //Query mislukt
        print 'Query mislukt';
        exit;
    }

    $result = $stmt->get_result();

    //de ingevoerde username bestaat niet er worden dus 0 records gevonden
    if ($result->num_rows === 0)
    {
        print 'Gebruiker niet gevonden';
        exit;
    }

    $user = $result->fetch_assoc();

    //is de $sql query gelukt & is er een record gevonden
    //dan gaan we het ingevoerde password vergelijken met de passwordhash uit de database
    if (password_verify($password, $user['PasswordHash']))
    {
        print 'aanmelden gelukt <br />';

        $_SESSION['user'] = $user['UserName'];
        $_SESSION['isadmin'] = $user['IsAdmin'];
        /* Redirect to UserOverzicht page */
        header('Location: UserOverzicht.php'); //dit moet de index pagina worden
    }
    else
    {
        print 'aanmelden mislukt!';
    }
    $result->free();
    $link->close();
}

//mochten een ingelogde gebruiker onverhoopt toch terugkomen op deze login pagina 
//dan wordt hij/zij terug naar de index pagina gestuurd
if (isset($_SESSION['user']))
{
    header('Location: UserOverzicht.php'); //dit moet de index pagina worden
}
?>
<HTML>
    <head>
        <meta charset="uft-8">
        <title></title>
        <link rel="stylesheet" href="../Style/bootstrap.min.css">
    </head>
    <body>
        <form method="post">
            <div>
                <label>Gebruikersnaam: </label><br>
                <input type="text" name="UserName" required/><br><br>
                <label>Wachtwoord: </label><br>
                <input type="password" name="Password" required/><br><br>
                <input type="submit" value="inloggen">
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
</html>