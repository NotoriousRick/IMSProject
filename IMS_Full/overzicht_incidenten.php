<?php
include "config.php";

$query = $db->prepare('select Incident_ID, Datum, Behandelaar from incident order by Datum asc');
$query->execute();
$row = $query->fetchAll(PDO::FETCH_OBJ);

?>
    <div id="sticky" class="row text-left d-flex align-items-center sticky-top">
        <div class="col-lg-3 btn text-left s">ID nummer incident</div>
        <div class="col-lg-3 btn text-left s">Datum aanmelding</div>
        <div class="col-lg-3 btn text-left s">Looptijd incident</div>
        <div class="col-lg-3 btn text-left s">Wordt behandeld door</div>
    </div>
<?php displayResult($row);?>