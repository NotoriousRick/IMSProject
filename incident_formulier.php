<?php
include "config.php";
$type_klant = 'SELECT * from TypeKlant';
$type_klant_result = $mysqli->query($type_klant);

$soort_incident = 'SELECT * from SoortIncident';
$soort_incident_result = $mysqli->query($soort_incident);
$getDate = date("Y-m-d");
?>
<style>
    /* webkit solution */  ::-webkit-input-placeholder { text-align:right; }
    /* mozilla solution */  input:-moz-placeholder { text-align:right; }
</style>
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
                                   name="Baliemedewerker" placeholder="*">
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
                                   name="Naam" placeholder="*">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Type klant</span>
                            </div>
                            <select class="select_two TypeKlant" name="TypeKlant" id="TypeKlant" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled">*</option>
                                <?php
                                while ($row = $type_klant_result->fetch_assoc()) {
                                    echo '<option value=' . $row["Type_ID"] . '>' . $row["TypeKlant"] . '</option>';
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
                                   name="Telefoon"  placeholder="*">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text id_number" id="span_margin_radius_padding">ID Nummer</span>
                            </div>
                            <input type="text" class="form-control form-control-sm id_number" id="input_margin_radius_padding"
                                   name="ID_Nummer">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Email</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Email" placeholder="*">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Soort incident</span>
                            </div>
                            <select class="select_two" name="SoortIncident" id="SoortIncident" style="width:60%; border:none;">
                                <option selected disabled>*</option>
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
                        <textarea class="form-control" name="Omschrijving" id="" cols="30" rows="5" placeholder="*"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <label><h6>Actie</h6></label>
                        <textarea class="form-control" name="Actie" id="" cols="30" rows="5" placeholder="*"></textarea>
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
                               name="Behandelaar" placeholder="*">
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
                    <div class="form-group">
                        <div class="col">
                            <label><h6>Gereed voor sluiten</h6></label>
                            <input type="checkbox" name="GereedVoorSluiten1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label><h6>Incident gesloten</h6></label>
                            <input type="checkbox" name="GereedVoorSluiten2" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label><h6>Sluit datum</h6></label>
                            <input type="text" name="SluitDatum" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" id="yourButton" class="btn btn-custom btn-info" value="Opslaan">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button class="btn btn-custom-print btn-light" onclick="window.print()">Print</button>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_klant = $mysqli->prepare('INSERT INTO Klant(
    Naam,
    Telefoon,
    Email,
    Type_ID
    )
    VALUES(
    ?,?,?,?)');
    // TODO select existing client id for form submit,  from database or choose the next client id based on last client made
    $insert_klant->bind_param('ssss',$klant_name,$klant_phone, $klant_email, $klant_customer_type);
    $klant_name = mysqli_real_escape_string($mysqli,$_POST["Naam"]);
    $klant_phone = mysqli_real_escape_string($mysqli,$_POST["Telefoon"]);
    $klant_email = mysqli_real_escape_string($mysqli,$_POST["Email"]);
    $klant_customer_type = mysqli_real_escape_string($mysqli,$_POST["TypeKlant"]);
    $insert_klant->execute();
    $insert_klant->close();
    
    $incident_collaborator = mysqli_real_escape_string($mysqli,$_POST['Baliemedewerker']);
    $incident_treated_by = mysqli_real_escape_string($mysqli,$_POST['Behandelaar']);
    $incident_description = mysqli_real_escape_string($mysqli,$_POST['Omschrijving']);
    $incident_action = mysqli_real_escape_string($mysqli,$_POST['Actie']);
    $incident_follow_up_action = mysqli_real_escape_string($mysqli,$_POST['VervolgActie']);
    $incident_executed_work = mysqli_real_escape_string($mysqli,$_POST['UitgevoerdeWerkzaamheden']);
    $incident_appointments = mysqli_real_escape_string($mysqli,$_POST['Afspraken']);
    $incident_type = mysqli_real_escape_string($mysqli,$_POST['SoortIncident']);

//    $incident_ready_for_closing = mysqli_real_escape_string($mysqli,$_POST['GereedVoorSluiten']);
//    $incident_closed = mysqli_real_escape_string($mysqli,$_POST['IncidentGesloten']);

    // TODO Fix this please
    $incident_ready_for_closing = 0;
    $incident_closed = 0;
    $client_id = 3;

    $insert_incident = $mysqli->prepare('INSERT INTO Incident(
    Datum,
    Baliemedewerker,
    Behandelaar,
    Omschrijving,
    Actie,
    VervolgActie,
    UitgevoerdeWerkzaamheden,
    Afspraken,
    SoortIncident_ID,
    GereedVoorSluiten,
    IncidentGesloten, 
    Klant_ID
    )  
    VALUES(
    ?,?,?,?,?,?,?,?,?,?,?,?
    )');
    $insert_incident->bind_param('ssssssssssss', $getDate, $incident_collaborator, $incident_treated_by, $incident_description, $incident_action, $incident_follow_up_action, $incident_executed_work, $incident_appointments, $incident_type);
    $insert_incident->execute();
    $insert_incident->close();
//    if(mysqli_query($mysqli, $insert_klant))
//    {
//        echo 'Klant saved' . '<br />';
//    }
//    else{
//        echo $mysqli->error;
//    }

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
