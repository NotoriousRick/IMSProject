<?php include 'DBConnection.php';
//$sql_klant = 'INSERT INTO klant(Naam, Telefoon, E-mail, Type_ID) VALUES ("peter", "08374983743", "example@example.com", $_POST[''])';
//if(mysqli_query($mysqli, $sql_klant)){
//    echo "Records inserted successfully.";
//} else{
//    echo "ERROR: Could not able to execute $sql_klant. " . mysqli_error($mysqli);
//}

$type_klant = 'SELECT * from typeklant';
$type_klant_result = $mysqli->query($type_klant);

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
<form method="post" action="index.php">
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
                                   name="incident_number">
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
                                   name="collaborator">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Datum</span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
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
                                   name="name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Type klant</span>
                            </div>
                            <select class="select_two" name="customer_type" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled"></option>
                                <?php
//                              Here are all types of customers in a select box.
                                while ($row = $type_klant_result->fetch_assoc()) {
                                echo '<option>' . $row["TypeKlant"] . '</option>';
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
                                   name="phone">
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
                                   name="email">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span_margin_radius_padding">Soort incident</span>
                            </div>
                            <select class="select_two" name="type_of_notification" style="width:60%; border:none;">
                                <option selected="true" disabled="disabled"></option>
                                <option>Software incident</option>
                                <option>Hardware incident</option>
                                <option>Advies</option>
                                <option>Verzoek</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <label><h6>Omschrijving incident</h6></label>
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <label><h6>Actie</h6></label>
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label><h6>Vervolg actie</h6></label>
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                            <label><h6> Behandeld door</h6></label>
                        <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"
                               name="treated by">
                    </div>
                </div>
                <div class="row">
                        <div class="col">
                            <label><h6>Uitgevoerde werkzaamheden</h6></label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <label><h6>Afspraken</h6></label>
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="practitioner">Behandelaar</label>
                            <input type="checkbox" name="practitioner">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="desk_employee">Balie medewerker</label>
                            <input type="checkbox" name="desk_employee">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="rounded_date">Datum</label>
                            <input type="text" id="rounded_date" name="rounded_date" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" id="save" class="btn btn-primary" value="Opslaan   ">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" id="save" class="btn btn-warning" value="Annuleren">
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
    $sql = "INSERT INTO klant()";
    echo $_POST["collaborator"];
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
</script>
</html>
