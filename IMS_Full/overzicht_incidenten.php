<?php
include "config.php";

$query = $db->prepare('select Incident_ID, Datum, Behandelaar from incident order by Datum asc');
$query->execute();
$row = $query->fetchAll(PDO::FETCH_OBJ);

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
    <body>
    <div id="sticky" class="row text-left d-flex align-items-center sticky-top">
        <div class="col-lg-3 btn text-left s">ID nummer incident</div>
        <div class="col-lg-3 btn text-left s">Datum aanmelding</div>
        <div class="col-lg-3 btn text-left s">Looptijd incident</div>
        <div class="col-lg-3 btn text-left s">Wordt behandeld door</div>
    </div>
            <?php displayResult($row);?>
    </body>
</html>
