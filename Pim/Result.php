<?php

error_reporting( error_reporting() & ~E_NOTICE );

include "../config.php";
//$datum = $_POST['datum'];
//$einddatum = $_POST['einddatum'];
//$incident = $_POST['incident'];
//$soortincident = $_POST['soortincident'];
//$typeklant = $_POST['typeklant'];
//$baliemedewerker = $_POST['baliemedewerker'];
//$behandelaar = $_POST['behandelaar'];
//$where = 'WHERE';
$sql = 'select i.*, k.Naam, k.Telefoon, k.Email, s.SoortIncident, t.TypeKlant from Incident i
        right join Klant k 
        on i.Klant_ID = k.Klant_ID
        right join SoortIncident s
        on i.SoortIncident_ID = s.SoortIncident_ID
        right join TypeKlant t
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
$columns = array();

$keys = $query->fetch(PDO::FETCH_ASSOC);
$keysArr = array_keys($keys);
foreach($keysArr as $col){
    $columns['columns'][] = array("data"=>$col);
}

while($row = $query->fetch(PDO::FETCH_ASSOC)){

    foreach ($row as $key => $value) {
        $dataRapport['data'][] = array($key => $value);
    }

}
//$rows = $query->fetchAll(PDO::FETCH_OBJ);
//$row = $query->fetchAll(PDO::FETCH_OBJ);

//$row = $query->fetch(PDO::FETCH_ASSOC);
//while($row = $query->fetch(PDO::FETCH_ASSOC)) {
//
//    $delta_time = time() - strtotime($datum);
//    $days = floor($delta_time / 3600 / 24); // difference in days
//    $colorCheck = getTimeColor($datum);
//    $duration = getDurationIncident($datum) . ' dagen';
//}





//echo json_encode($columns);

//print_array($dataRapport);
echo json_encode($dataRapport);