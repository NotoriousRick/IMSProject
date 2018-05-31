<?php include 'DBConnection.php';

$type_klant = 'SELECT * from typeklant';
$type_klant_result = $mysqli->query($type_klant);

$soort_incident = 'SELECT * from soortincident';
$soort_incident_result = $mysqli->query($soort_incident);

?>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/Custom.css">
    <link rel="stylesheet" href="Public/AdminLTE/AdminLTE.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <title>IMS</title>
</head>
<body>
<form method="post" action="index.php" id="formulier">
    <div class="container">
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>INCIDENT FORMULIER</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">ID</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Incident_ID">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Balie medewerker</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Baliemedewerker">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Datum</span>
                            </div>
                            <input type="hidden" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <h3>Klantgegevens</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body with-border">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Naam</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Naam">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Type klant</span>
                            </div>
                            <select class="select_two" name="TypeKlant" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                while ($row = $type_klant_result->fetch_assoc()) {
                                echo '<option value=' . $row['Type_ID'] . '>' . $row["TypeKlant"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Telefoon</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Telefoon">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">ID nummer</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="extra_subject">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Email</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Email">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Soort incident</span>
                            </div>
                            <select class="select_two" name="SoortIncident_ID" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                while($row = $soort_incident_result->fetch_assoc())
                                {
                                    echo '<option value="' . $row['SoortIncident_ID'] . '">' . $row['SoortIncident'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <label><h6>Omschrijving incident</h6></label>
                        <textarea class="form-control" name="Omschrijving" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <label><h6>Actie</h6></label>
                        <textarea class="form-control" name="Actie" id="" cols="30" rows="5"></textarea>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label><h6>Vervolg actie</h6></label>
                        <textarea class="form-control" name="VervolgActie" id="" cols="30" rows="5"></textarea>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                            <label><h6>Behandeld door</h6></label>
                        <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                               name="">
                        <br />
                    </div>
                </div>
                <div class="row">
                        <div class="col">
                            <label><h6>Uitgevoerde werkzaamheden</h6></label>
                            <textarea class="form-control" name="UitgevoerdeWerkzaamheden" cols="30" rows="5"></textarea>
                        </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <label><h6>Afspraken</h6></label>
                        <textarea class="form-control" name="Afspraken" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label><h6>Behandelaar</h6></label>
                            <input type="checkbox" name="Behandelaar" value="1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label><h6>Balie medewerker</h6></label>
                            <input type="checkbox" name="desk_employee">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label><h6>Sluit datum</h6></label>
                            <input type="text" name="rounded_date" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Opslaan">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <a class="btn btn-default" onclick="window.print()">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klant_name = mysqli_real_escape_string($mysqli,$_POST["Naam"]);
    $klant_phone = mysqli_real_escape_string($mysqli,$_POST["Telefoon"]);
    $klant_email = mysqli_real_escape_string($mysqli,$_POST["Email"]);
    $klant_customer_type = mysqli_real_escape_string($mysqli,$_POST["TypeKlant"]);

    $insert_klant = 'INSERT INTO klant(
    Naam,
    Telefoon,
    Email,
    Type_ID
    ) 
    VALUES(
    "' . $klant_name . '",
    "' . $klant_phone . '",
    "' . $klant_email . '",
    "' . $klant_customer_type . '"
    )';

    $incident_collaborator = mysqli_real_escape_string($mysqli,$_POST['Baliemedewerker']);
    $incident_treated_by = mysqli_real_escape_string($mysqli,$_POST['Behandelaar']);
    $incident_description = mysqli_real_escape_string($mysqli,$_POST['Omschrijving']);
    $incident_action = mysqli_real_escape_string($mysqli,$_POST['Actie']);
    $incident_follow_up_action = mysqli_real_escape_string($mysqli,$_POST['VervolgActie']);
    $incident_executed_work = mysqli_real_escape_string($mysqli,$_POST['UitgevoerdeWerkzaamheden']);
    $incident_appointments = mysqli_real_escape_string($mysqli,$_POST['Afspraken']);
    $incident_type = mysqli_real_escape_string($mysqli,$_POST['SoortIncident_ID']);

    $insert_incident = 'INSERT INTO incident(
    Datum, 
    Baliemedewerker, 
    Behandelaar, 
    Omschrijving, 
    Actie, 
    VervolgActie, 
    UitgevoerdeWerkzaamheden, 
    Afspraken,
    SoortIncident_ID
    ) 
    VALUES(
    "' . date("Y-m-d") . '", "' . $incident_collaborator . '",
    "' . $incident_treated_by . '", "' . $incident_description . '", 
    "' . $incident_action . '", "' . $incident_follow_up_action . '", 
    "' . $incident_executed_work . '", "' . $incident_appointments . '", 
    "' . $incident_type . '"
    )';

    if(mysqli_query($mysqli, $insert_klant))
    {
        echo 'Klant saved' . '<br />';
    }
    else{
        echo $mysqli->error;
    }

    if(mysqli_query($mysqli, $insert_incident))
    {
        echo 'Incident saved.';
    }
    else
    {
        echo $mysqli->error;
    }
}

?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!--SELECT 2 PLUGIN-->
<script>
    $(document).ready(function () {
        $('.select_two').select2();
    });

    // $('#formulier').submit(function (e) {
    //     e.preventDefault();
    // })
</script>
</html>
