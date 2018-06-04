<?php
include "config.php";
$type_klant = 'SELECT * from typeklant';
$type_klant_result = $mysqli->query($type_klant);

$soort_incident = 'SELECT * from soortincident';
$soort_incident_result = $mysqli->query($soort_incident);
$getDate = date("Y-m-d");
?>
<form method="post" id="formulier">
    <div class="container change" id="change">
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>INCIDENT FORMULIER</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group  sr-only">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">ID</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Incident_ID" disabled>
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
                            <input placeholder="<?=$getDate?>" class="form-control form-control-sm" id="input_margin_radius_padding" disabled
                                   name="Datum">
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
                            <select class="select_two" name="TypeKlant" id="TypeKlant" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                while ($row = $type_klant_result->fetch_assoc()) {
                                    echo '<option value=' . $row["TypeKlant"] . '>' . $row["TypeKlant"] . '</option>';
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
                                   name="ID_nummer">
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
                            <select class="select_two" name="SoortIncident" id="SoortIncident" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                while($row = $soort_incident_result->fetch_assoc())
                                {
                                    echo '<option value="' . $row['SoortIncident'] . '">' . $row['SoortIncident'] . '</option>';
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
                    </div>
                </div>
                <br />

                <div class="row" id="VervolgActie">
                    <div class="col">
                        <label><h6>Vervolg actie</h6></label>
                        <textarea class="form-control" name="VervolgActie" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <label><h6>Behandeld door</h6></label>
                        <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                               name="Behandelaar">
                    </div>
                </div>
                <br />
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
                            <input type="checkbox" name="GereedVoorSluiten">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label><h6>Balie medewerker</h6></label>
                            <input type="checkbox" name="nogwat" value="1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label><h6>Sluit datum</h6></label>
                            <input type="text" name="SluitDatum" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" class="btn btn-custom btn-info" value="Opslaan">
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
<script>
    $('.select_two').select2();
</script>
<?php
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $klant_name = mysqli_real_escape_string($mysqli,$_POST["Naam"]);
//    $klant_phone = mysqli_real_escape_string($mysqli,$_POST["Telefoon"]);
//    $klant_email = mysqli_real_escape_string($mysqli,$_POST["Email"]);
//    $klant_customer_type = mysqli_real_escape_string($mysqli,$_POST["TypeKlant"]);
//
//    $insert_klant = 'INSERT INTO klant(
//    Naam,
//    Telefoon,
//    Email,
//    Type_ID
//    )
//    VALUES(
//    "' . $klant_name . '",
//    "' . $klant_phone . '",
//    "' . $klant_email . '",
//    "' . $klant_customer_type . '"
//    )';
//
//    $incident_collaborator = mysqli_real_escape_string($mysqli,$_POST['Baliemedewerker']);
//    $incident_treated_by = mysqli_real_escape_string($mysqli,$_POST['Behandelaar']);
//    $incident_description = mysqli_real_escape_string($mysqli,$_POST['Omschrijving']);
//    $incident_action = mysqli_real_escape_string($mysqli,$_POST['Actie']);
//    $incident_follow_up_action = mysqli_real_escape_string($mysqli,$_POST['VervolgActie']);
//    $incident_executed_work = mysqli_real_escape_string($mysqli,$_POST['UitgevoerdeWerkzaamheden']);
//    $incident_appointments = mysqli_real_escape_string($mysqli,$_POST['Afspraken']);
//    $incident_type = mysqli_real_escape_string($mysqli,$_POST['SoortIncident_ID']);
//    $incident_ready_for_closing = mysqli_real_escape_string($mysqli,$_POST['GereedVoorSluiten']);
//    $incident_closed = mysqli_real_escape_string($mysqli,$_POST['IncidentGesloten']);
//
//    $insert_incident = 'INSERT INTO incident(
//    Datum,
//    Baliemedewerker,
//    Behandelaar,
//    Omschrijving,
//    Actie,
//    VervolgActie,
//    UitgevoerdeWerkzaamheden,
//    Afspraken,
//    SoortIncident_ID,
//    GereedVoorSluiten,
//    IncidentGesloten
//    )
//    VALUES(
//    "' . date("Y-m-d") . '", "' . $incident_collaborator . '",
//    "' . $incident_treated_by . '", "' . $incident_description . '",
//    "' . $incident_action . '", "' . $incident_follow_up_action . '",
//    "' . $incident_executed_work . '", "' . $incident_appointments . '",
//    "' . $incident_type . '", "' . $incident_ready_for_closing . '",
//    "' . $incident_closed . '"
//    )';
//
//    if(mysqli_query($mysqli, $insert_klant))
//    {
//        echo 'Klant saved' . '<br />';
//    }
//    else{
//        echo $mysqli->error;
//    }
//
//    if(mysqli_query($mysqli, $insert_incident))
//    {
//        echo 'Incident saved.';
//    }
//    else
//    {
//        echo $mysqli->error;
//    }
//}
