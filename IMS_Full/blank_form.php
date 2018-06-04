<?php
include "config.php";
$type_klant = 'SELECT * from typeklant';
$type_klant_result = $mysqli->query($type_klant);

$soort_incident = 'SELECT * from soortincident';
$soort_incident_result = $mysqli->query($soort_incident);
?>
<html>
<head>
    <link rel="stylesheet" href="AdminLTE/AdminLTE.min.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>IMS</title>
</head>
<body>
<form method="post" action="" id="formulier">
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
                                   name="Baliemedewerker" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Datum</span>
                            </div>
                            <input  class="form-control form-control-sm" id="input_margin_radius_padding" disabled
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
                                   name="Naam" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Type klant</span>
                            </div>
                            <input name="TypeKlant" class="form-control form-control-sm" id="input_margin_radius_padding" disabled>
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
                                   name="Telefoon" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">ID nummer</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="ID_nummer" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Email</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                                   name="Email" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Soort incident</span>
                            </div>
                            <select class="select_two " name="SoortIncident" id="span_margin_radius_padding" style="width:60%; border:none;">
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
<!--                <div class="row" id="but">-->
<!--                    <!--                Vervolg actie button-->
<!--                    <div class="col">-->
<!--                        <div class="form-group">-->
<!--                            <input type="button" id="addAction" class="btn btn-info btn-custom" value="Vervolg Actie">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="row VervolgActie">
                    <div class="col">
                        <label><h6>Vervolg actie</h6></label>
                        <textarea class="form-control" name="VervolgActie" cols="30" rows="5"></textarea>
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
                            <input type="checkbox" name="GereedVoorSluiten" value="1">
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
</body>
</html>

