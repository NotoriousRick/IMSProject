<?php
include "config.php";
$getDate = date("Y-m-d");


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

$edit_incident = $mysqli->prepare('update Incident
    set 
    Datum = '.$getDate.',
    Baliemedewerker = ?,
    Behandelaar = ?,
    Omschrijving = ?,
    Actie = ?,
    VervolgActie = ?,
    UitgevoerdeWerkzaamheden = ?,
    Afspraken = ?,
    SoortIncident_ID = ?,
    GereedVoorSluiten = ?,
    IncidentGesloten = ?
');

$edit_customer = $mysqli->prepare('update Klant
    set
    Naam = ?,
    Telefoon = ?,
    Email = ?,
    Where  Type_ID = '.$result_id.'
');
$edit_incident->bind_param('sssssssssss', $incident_collaborator, $incident_treated_by, $incident_description, $incident_action, $incident_follow_up_action, $incident_executed_work, $incident_appointments, $incident_type, $incident_ready_for_closing, $incident_closed);
$edit_incident->bind_param('sss',$klant_name, $klant_phone, $klant_email, $klant_customer_type);
$edit_incident->execute();
$edit_customer->execute();
$edit_customer->close();
$edit_incident->close();

echo 'noice';