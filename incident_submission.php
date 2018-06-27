<?php
include "config.php";

$type_klant = 'SELECT * from TypeKlant';
$type_klant_result = $mysqli->query($type_klant);

$soort_incident = 'SELECT * from SoortIncident';
$soort_incident_result = $mysqli->query($soort_incident);
$getDate = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_klant = $mysqli->prepare('INSERT INTO Klant(
    Naam,
    Telefoon,
    Email,
    Type_ID
    )
    VALUES(
    ?,?,?,?)');

    // TODO select existing client id for form submit,  from database or choose the next client id based on last client made
    $insert_klant->bind_param('ssss', $klant_name, $klant_phone, $klant_email, $klant_customer_type);
    $klant_name = mysqli_real_escape_string($mysqli, $_POST["Naam"]);
    $klant_phone = mysqli_real_escape_string($mysqli, $_POST["Telefoon"]);
    $klant_email = mysqli_real_escape_string($mysqli, $_POST["Email"]);
    $klant_customer_type = mysqli_real_escape_string($mysqli, $_POST["TypeKlant"]);

    $result = $mysqli->prepare('select Klant_ID from klant
     where (Naam = ' . $klant_name . ' and Telefoon = ' . $klant_phone . ' and Email = ' . $klant_email . ')');

    if ($row = $query->fetch(PDO::FETCH_OBJ)) {
        //als klant bestaat, return klant_id
        $klant_id = $result["Klant_ID"];
    } else if (isset($insert_klant, $klant_name, $klant_phone, $klant_email, $klant_customer_type)) {
        // als klant niet bestaat, return last klant_id +1

        // result = select last_auto_increment van Klant_ID
        // klant_id = result +1

        // maak klant aan
        $insert_klant->execute();
    } else {
        // doe wat
    }

    $insert_klant->close();

    $incident_collaborator = mysqli_real_escape_string($mysqli, $_POST['Baliemedewerker']);
    $incident_treated_by = mysqli_real_escape_string($mysqli, $_POST['Behandelaar']);
    $incident_description = mysqli_real_escape_string($mysqli, $_POST['Omschrijving']);
    $incident_action = mysqli_real_escape_string($mysqli, $_POST['Actie']);
    $incident_follow_up_action = mysqli_real_escape_string($mysqli, $_POST['VervolgActie']);
    $incident_executed_work = mysqli_real_escape_string($mysqli, $_POST['UitgevoerdeWerkzaamheden']);
    $incident_appointments = mysqli_real_escape_string($mysqli, $_POST['Afspraken']);
    $incident_type = mysqli_real_escape_string($mysqli, $_POST['SoortIncident']);

//    $incident_ready_for_closing = mysqli_real_escape_string($mysqli,$_POST['GereedVoorSluiten']);
//    $incident_closed = mysqli_real_escape_string($mysqli,$_POST['IncidentGesloten']);

    // TODO Fix this please
    $incident_ready_for_closing = 0;
    $incident_closed = 0;
    $client_id = 3;

//deze regels code tot aan het eerste else statement zijn nodig voor de server side validation
    $Fouten = "";

//in deze sring lengte if-statement controleren we server side of de verplichte velden zijn gezet/ingevuld
    if (strlen($klant_name) === 0) {
        $Fouten = $Fouten . "Vul een klantnaam in.";
    }
    if (strlen($klant_phone) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul het telefoonnummer van de klant in.";
    }
    if (strlen($klant_email) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul het email van de klant in.";
    }
    if (strlen($klant_customer_type) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul het type klant in.";
    }
    if (strlen($incident_collaborator) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul de baliemedewerker in.";
    }
    if (strlen($incident_treated_by) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul de behandelaar in.";
    }
    if (strlen($incident_description) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul het omschrijving veld in.";
    }
    if (strlen($incident_action) === 0) {
        $Fouten = $Fouten . "<br>" . " Vul het actie veld in.";
    }
    if (strlen($incident_type) === 0) {
        $Fouten = $Fouten . "<br>" . "Vul het soort incident in.";
    }

//dit if statement is nodig om via de pnotify plugin de server side validation te kunnen tonen aan de gebruiker
    if (strlen($Fouten) > 0) {
        ob_clean();
        http_response_code(400);
        print $Fouten;
        exit();
    } else {


        $insert_incident = $mysqli->prepare('INSERT INTO Incident(
    Datum,
    Baliemedewerker,
    Behandelaar,
    Omschrijving,
    Actie,
    VervolgActie,
    UitgevoerdeWerkzaamheden,
    Afspraken,
    SoortIncident_ID,
    GereedVoorSluiten,
    IncidentGesloten, 
    Klant_ID
    )  
    VALUES(
    ?,?,?,?,?,?,?,?,?,?,?,?
    )');
        $insert_incident->bind_param('ssssssssssss', $getDate, $incident_collaborator, $incident_treated_by, $incident_description, $incident_action, $incident_follow_up_action, $incident_executed_work, $incident_appointments, $incident_type);
        $insert_incident->execute();
        $insert_incident->close();

//    if(mysqli_query($mysqli, $insert_klant))
//    {
//        echo 'Klant saved' . '<br />';
//    }
//    else{
//        echo $mysqli->error;
//    }

        if (mysqli_query($mysqli, $insert_incident)) {
            echo 'Incident saved.';
        } else {
            echo $mysqli->error;
        }
    }
}
?>


