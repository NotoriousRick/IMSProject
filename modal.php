<?php
$type_klant = 'SELECT * from TypeKlant';
$type_klant_result = $mysqli->query($type_klant);

$soort_incident = 'SELECT * from SoortIncident';
$soort_incident_result = $mysqli->query($soort_incident);
$getDate = date("Y-m-d");
?>
<div id="fModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="min-width: 1200px">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <form method="post" action="" id="formulier">
                    <div class="row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">Formulier ID</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                       name="Incident_ID" disabled>
                        </div>
                    </div>
                </form>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
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
                                            <select class="TypeKlant sel form-control form-control-sm" name="TypeKlant" id="TypeKlant" style="width:60%; border:none;">
                                                <option selected="true" disabled>*</option>
                                                <?php
                                                while ($row = $type_klant_result->fetch_assoc()) {
                                                    echo '<option  value=' . $row["Type_ID"] . '>' . $row["TypeKlant"] . '</option>';
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
                                                <span class="input-group-text id_number" id="span_margin_radius_padding">ID nummer</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm id_number" id="input_margin_radius_padding"
                                                   name="ID_nummer">
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
                                            <select class="sel form-control form-control-sm" name="SoortIncident" id="SoortIncident" style="width:60%; border:none;">
                                                <option selected disabled>*</option>
                                                <?php
                                                while($row = $soort_incident_result->fetch_assoc())
                                                {
                                                    // value= $row['SoortIncident_ID'] dit moet het oplossen
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" id="yourButton" class="btn btn-custom btn-info" value="Opslaan">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button class="btn btn-custom-print btn-light" onclick="window.print()">Printen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>