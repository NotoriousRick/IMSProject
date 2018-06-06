<?php
// Get data to fill the incident form
include "config.php";

$stmt = 'select * 
from Incident i
right join Klant k on i.Klant_ID = k.Klant_ID
right join SoortIncident s on i.SoortIncident_ID = s.SoortIncident_ID
right join TypeKlant t on k.Type_ID = t.Type_ID 
where Incident_ID = :id';

$query = $db->prepare($stmt);
$query->bindParam(":id",$_POST['id']);
$query->execute();
$row = $query->fetch(PDO::FETCH_OBJ);

$results = $query->fetchAll(PDO::FETCH_OBJ);


echo json_encode($row);