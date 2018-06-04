<?php
include "config.php";

$stmt = 'select * 
from incident i
right join klant k on i.Klant_ID = k.Klant_ID
right join soortincident s on i.SoortIncident_ID = s.SoortIncident_ID
right join typeklant t on k.Type_ID = t.Type_ID 
where Incident_ID = :id';

$query = $db->prepare($stmt);
$query->bindParam(":id",$_POST['id']);
$query->execute();
$row = $query->fetch(PDO::FETCH_OBJ);

$results = $query->fetchAll(PDO::FETCH_OBJ);


echo json_encode($row);