<?php



include "../config.php";
//$datum = $_POST['datum'];
//$einddatum = $_POST['einddatum'];
//$incident = $_POST['incident'];
//$soortincident = $_POST['soortincident'];
//$typeklant = $_POST['typeklant'];
//$baliemedewerker = $_POST['baliemedewerker'];
//$behandelaar = $_POST['behandelaar'];
//$where = 'WHERE';
$sql = 'select i.*, k.Naam, s.SoortIncident, t.TypeKlant from Incident i
        left join Klant k 
        on i.Klant_ID = k.Klant_ID
        left join SoortIncident s
        on i.SoortIncident_ID = s.SoortIncident_ID
        left join TypeKlant t
        on k.Type_ID = t.Type_ID
        ';

//if (!empty($datum)){
//    $sql = $sql . $where . " Datum >= :datum ";
//    $where = 'AND';
//}
//if (!empty($einddatum)){
//    $sql = $sql . $where . " Datum <= :einddatum ";
//    $where = 'AND';
//}
//if (!empty($incident)){
//    if ($incident == "gesloten"){
//        $sql = $sql . $where . " IncidentGesloten = 1 ";
//    }
//    else if ($incident == "open"){
//        $sql = $sql . $where . " IncidentGesloten = 0 ";
//    }
//    else if($incident !== 'alles'){
//        $where = 'AND';
//    }
//}
//if (!empty($soortincident)){
//    if ($soortincident == "software"){
//        $sql = $sql . $where . " SoortIncident_ID = 1 ";
//    }
//    else if ($soortincident == "hardware"){
//        $sql = $sql . $where . " SoortIncident_ID = 2 ";
//    }
//    else if ($soortincident == "advies"){
//        $sql = $sql . $where . " SoortIncident_ID = 3 ";
//    }
//    else if ($soortincident == "verzoek"){
//        $sql = $sql . $where . " SoortIncident_ID = 4 ";
//    }
//    else if($soortincident !== 'alles'){
//        $where = 'AND';
//    }
//}
//if (!empty($typeklant)){
//    if ($typeklant == "student"){
//        $sql = $sql . $where . " Klant_ID = 1 ";
//    }
//    else if ($typeklant == "docent"){
//        $sql = $sql . $where . " Klant_ID = 2 ";
//    }
//    else if ($typeklant == "extern"){
//        $sql = $sql . $where . " Klant_ID = 3 ";
//    }
//    else if($typeklant !== 'alles'){
//        $where = 'AND';
//    }
//}
//if (!empty($baliemedewerker)){
//    $sql = $sql . $where . " Baliemedewerker = :baliemedewerker ";
//    $where = 'AND';
//}
//if (!empty($behandelaar)){
//    $sql = $sql . $where . " Behandelaar = :behandelaar ";
//    $where = 'AND';
//}
//$query = $db->prepare($sql);
//if (!empty($datum)){
//    $query->bindparam(':datum', $datum);
//}
//if (!empty($einddatum)){
//    $query->bindparam(':einddatum', $einddatum);
//}
//if (!empty($baliemedewerker)){
//    $query->bindparam(':baliemedewerker', $baliemedewerker);
//}
//if (!empty($behandelaar)){
//    $query->bindparam(':behandelaar', $behandelaar);
//}

$query = $db->prepare($sql);
$query->execute();

$dataRapport["data"] = array();

while($row = $query->fetch(PDO::FETCH_OBJ)) {
    $datum = $row->Datum;
    $delta_time = time() - strtotime($datum);
    $days = floor($delta_time / 3600 / 24); // difference in days
    $duration = getDurationIncident($datum) . ' dagen';
    $dataRapport["data"][] = array(
        "DT_RowId" => "id".$row->Incident_ID,
        "Incident_ID" => $row->Incident_ID,
        "Datum" => $row->Datum,
        "duration" => $days,
        "Naam" =>$row->Naam,
        "Baliemedewerker" => $row->Baliemedewerker,
        "Behandelaar" => $row->Behandelaar,
        "SluitDatum" => $row->SluitDatum,
        "IncidentGesloten" => $row->IncidentGesloten,
        "Klant_ID" => $row->Klant_ID,
        "SoortIncident_ID" => $row->SoortIncident_ID
    );
}

echo json_encode($dataRapport);
