<?php
// Gets data for DataTables plugin, page "Overzicht lopende incidenten"
include "config.php";
$query = $db->prepare('select Incident_ID, Datum, k.Naam from Incident i
                                 right join Klant k 
                                 on i.Klant_ID = k.Klant_ID');
$query->execute();
//$row = $query->fetch(PDO::FETCH_OBJ);

$mysql_data[]= array();
$dataIncident["data"] = array();

while($row = $query->fetch(PDO::FETCH_OBJ)) {
    $incident_id = $row->Incident_ID;
    $datum = $row->Datum;
    $naam = $row->Naam;
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
        "naam" => $naam,
        "days" => $days
    );
}
print json_encode($dataIncident);