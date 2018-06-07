<?php
include '../config.php';

$q = $db->prepare("DESCRIBE Incident");
$q->execute();
$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($table_fields);