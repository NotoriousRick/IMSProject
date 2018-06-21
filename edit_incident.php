<?php
error_reporting( error_reporting() & ~E_NOTICE );

include "config.php";
$getDate = date("Y-m-d");

$incident_id = $_POST['Incident_ID'];
$incident_collaborator = mysqli_real_escape_string($mysqli,$_POST['Baliemedewerker']);
$incident_treated_by = mysqli_real_escape_string($mysqli,$_POST['Behandelaar']);
$incident_description = mysqli_real_escape_string($mysqli,$_POST['Omschrijving']);
$incident_action = mysqli_real_escape_string($mysqli,$_POST['Actie']);
$incident_follow_up_action = mysqli_real_escape_string($mysqli,$_POST['VervolgActie']);
$incident_executed_work = mysqli_real_escape_string($mysqli,$_POST['UitgevoerdeWerkzaamheden']);
$incident_appointments = mysqli_real_escape_string($mysqli,$_POST['Afspraken']);
$incident_type = mysqli_real_escape_string($mysqli,$_POST['SoortIncident']);

$incident_ready_for_closing = 0;
$incident_closed = 0;
$client_id = 2;

$klant_name = mysqli_real_escape_string($mysqli,$_POST["Naam"]);
$klant_phone = mysqli_real_escape_string($mysqli,$_POST["Telefoon"]);
$klant_email = mysqli_real_escape_string($mysqli,$_POST["Email"]);
$klant_customer_type = mysqli_real_escape_string($mysqli,$_POST["TypeKlant"]);

$edit_incident = $db->prepare('update Incident
    set 
    Datum = '.$getDate.',
    Baliemedewerker = :balie,
    Behandelaar = :bahandelaar,
    Omschrijving = :omschrijving,
    Actie = :actie,
    VervolgActie = :vactie,
    UitgevoerdeWerkzaamheden = :uwerkzaamheden,
    Afspraken = :afspraken,
    SoortIncident_ID = :incidentid,
    GereedVoorSluiten = :gvoorsluiten,
    IncidentGesloten = :incidentgesloten
');

$query = $db->prepare('select Type_ID from Incident where Incident_ID = '.$incident_id.'');
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$result_id = $result['Type_ID'];

echo $result_id;
$edit_customer = $db->prepare('update Klant
    set
    Naam = :naam,
    Telefoon = :tel,
    Email = :email,
    Where  Type_ID = '.$result_id.'
');

$edit_incident->bindParam(':balie',$incident_collaborator);
$edit_incident->bindParam(':bahandelaar',$incident_treated_by);
$edit_incident->bindParam(':omschrijving',$incident_description);
$edit_incident->bindParam(':actie', $incident_action);
$edit_incident->bindParam(':vactie',$incident_follow_up_action);
$edit_incident->bindParam(':uwerkzaamheden',$incident_executed_work);
$edit_incident->bindParam(':afspraken',$incident_appointments);
$edit_incident->bindParam(':incidentid',$incident_type);
$edit_incident->bindParam(':gvoorsluiten',$incident_ready_for_closing);
$edit_incident->bindParam(':incidentgesloten',$incident_closed);


$edit_customer->bindParam(':naam',$klant_name);
$edit_customer->bindParam(':tel',$klant_phone);
$edit_customer->bindParam(':email',$klant_email);

$edit_incident->execute();
$edit_customer->execute();

echo 'noice';