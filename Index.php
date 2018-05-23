<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/Custom.css">
        <link rel="stylesheet" href="Public/AdminLTE/AdminLTE.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <title>IMS</title>
    </head>
    
    <body>
        <div class="container" id="container_navbar">
            <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
                <a class="navbar-brand" href="#">IMS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-default" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
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
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding" name="incident_number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">Medewerker</span>
                                  	</div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding" name="collaborator">
                        </div>
                      </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">Datum</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"  name="date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body with-border">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">Type klant</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"  name="customer_type">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">Naam</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"  name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">Telefoon</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"  name="phone">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span_margin_radius_padding">E-mailadres</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"  name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="span_margin_radius_padding">Incident</span>
                              </div>
                            <select class="select_two" name="type_of_notification" style="width:60%; border:none;">
                                <option>Incident 1</option>
                                <option>Incident 2</option>
                                <option>Incident 3</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="span_margin_radius_padding">Evt extra vak</span>
                              </div>
                            <input type="text" class="form-control form-control-sm" id="input_margin_radius_padding"  name="extra_subject">
                          </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <textarea class="form-control form-control-sm" id="input_margin_radius_padding" rows="5" placeholder="Omschrijving incident"></textarea>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col">

                            <input type="text" class="form-control form-control-sm"  id="input_margin_radius_padding" name="treated by" placeholder="Behandeld door">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="jumbotron" id="jumbotron_margin">
                                <h3>Actie</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="jumbotron" id="jumbotron_margin">
                                <h3>Uitgevoerde werkzaamheden</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="jumbotron" id="jumbotron_margin">
                                <h3>Afspraken</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id="input_margin_radius_padding" name="rounded_date" placeholder="Afgeronde datum">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="input_margin_radius_padding" name="signature_office" placeholder="Handtekening kantoor">
                        </div>
                        <div class="col">
                            <a class="btn btn-default float-right" href="#">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.select_two').select2();
        });
    </script>

</html>
