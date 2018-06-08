<?php

error_reporting( error_reporting() & ~E_NOTICE );

include "../config.php";
$datum = $_POST['datum'];
$einddatum = $_POST['einddatum'];
$incident = $_POST['incident'];
$soortincident = $_POST['soortincident'];
$typeklant = $_POST['typeklant'];
$baliemedewerker = $_POST['baliemedewerker'];
$behandelaar = $_POST['behandelaar'];
$where = 'WHERE';
$test = 'select Incident_ID, Datum, k.Naam from Incident i
                                 right join Klant k 
                                 on i.Klant_ID = k.Klant_ID ';

if (!empty($datum)){
    $test = $test . $where . " datum >= :datum ";
    $where = 'AND';
}
if (!empty($einddatum)){
    $test = $test . $where . " datum <= :einddatum ";
    $where = 'AND';
}
if (!empty($incident)){
    if ($incident == "gesloten"){
        $test = $test . $where . " incidentgesloten = 1 ";
    }
    else if ($incident == "open"){
        $test = $test . $where . " incidentgesloten = 0 ";
    }
    $where = 'AND';
}
if (!empty($soortincident)){
    if ($soortincident == "software"){
        $test = $test . $where . " soortincident_ID = 1 ";
    }
    else if ($soortincident == "hardware"){
        $test = $test . $where . " soortincident_ID = 2 ";
    }
    else if ($soortincident == "advies"){
        $test = $test . $where . " soortincident_ID = 3 ";
    }
    else if ($soortincident == "verzoek"){
        $test = $test . $where . " soortincident_ID = 4 ";
    }
    $where = 'AND';
}
if (!empty($typeklant)){
    if ($typeklant == "student"){
        $test = $test . $where . " klant_ID = 1 ";
    }
    else if ($typeklant == "docent"){
        $test = $test . $where . " klant_ID = 2 ";
    }
    else if ($typeklant == "extern"){
        $test = $test . $where . " klant_ID = 3 ";
    }
    $where = 'AND';
}
if (!empty($baliemedewerker)){
    $test = $test . $where . " baliemedewerker = :baliemedewerker ";
    $where = 'AND';
}
if (!empty($behandelaar)){
    $test = $test . $where . " behandelaar = :behandelaar ";
    $where = 'AND';
}
$query = $db->prepare($test);
if (!empty($datum)){
    $query->bindparam(':datum', $datum);
}
if (!empty($einddatum)){
    $query->bindparam(':einddatum', $einddatum);
}
if (!empty($baliemedewerker)){
    $query->bindparam(':baliemedewerker', $baliemedewerker);
}
if (!empty($behandelaar)){
    $query->bindparam(':behandelaar', $behandelaar);
}

$query->execute();

$dataRapport['data']= array();

while($row = $query->fetch(PDO::FETCH_OBJ)) {
    $datum = $row->Datum;
    $delta_time = time() - strtotime($datum);
    $days = floor($delta_time / 3600 / 24); // difference in days
    $colorCheck = getTimeColor($datum);
    $duration = getDurationIncident($datum) . ' dagen';
    $dataRapport['data'][] = array(
        "DT_RowId" => "id".$row->Incident_ID,
        "incidentId" => $row->Incident_ID,
        "datum" => $row->Datum,
        "duration" => $days,
        "naam" =>$row->Naam,
        "days" => $days
    );
}
echo $test;
echo json_encode($dataRapport);