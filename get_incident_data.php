<?php
// Gets data for DataTables plugin, page "Overzicht lopende incidenten"
include "config.php";
$query = $db->prepare('select Incident_ID, Datum, Behandelaar from Incident');
$query->execute();
//$row = $query->fetch(PDO::FETCH_OBJ);

$mysql_data[]= array();
$dataIncident["data"] = array();

while($row = $query->fetch(PDO::FETCH_OBJ)) {
    $incident_id = $row->Incident_ID;
    $datum = $row->Datum;
    $behandelaar = $row->Behandelaar;
    $id = $incident_id;
    $delta_time = time() - strtotime($datum);
    $days = floor($delta_time / 3600 / 24); // difference in days
    $colorCheck = getTimeColor($datum);
    $duration = getDurationIncident($datum) . ' dagen';
    $dataIncident["data"][] = array(
        "DT_RowId" => "id".$row->Incident_ID,
        "incidentId" => $row->Incident_ID,
        "datum" => $row->Datum,
        "duration" => $days,
        "behandelaar" => $behandelaar,
        "days" => $days
    );
}
print json_encode($dataIncident);