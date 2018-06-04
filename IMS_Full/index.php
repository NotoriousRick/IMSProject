<?php
include "config.php";

$query = $db->prepare('select Incident_ID, Datum, Behandelaar from incident order by Datum asc');
$query->execute();
$row = $query->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="style.css">

</head>
    <body>
<!--  Navbar     -->
    <div id="collapsedNavbar" class="">

    </div>
        <nav class="navbar navbar-light navbar-custom fixed-top navbar-main" style="margin:-1px 0;">
            <nav class="navbar navbar-expand-sm">
    <!--  Logo -->

                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="images/logo%20ims2.0.png" alt="Logo" style="width:100px;">
                </a>

    <!--   3 content links   -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button id="overzicht" type="button" class="btn btn-info btn-custom">Overzicht lopende incidenten</button>
                    </li>
                    <li class="nav-item">
                        <button id="incident" type="button" class="btn btn-info btn-custom">Nieuw incident melden</button>
                    </li>
                    <li class="nav-item">
                        <button id="rapport" type="button" class="btn btn-info btn-custom">Rapportages</button>
                    </li>
                    <li class="nav-item">
                        <button id="test" type="button" class="btn btn-info btn-custom">Test page</button>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-expand-sm  ml-auto">
                <ul class="navbar-nav">
    <!--    Navbar settings toggler    -->
                    <li class="nav-item">
                        <button id="settings" class="btn btn-info btn-custom dropdown-toggle fas fa-cog" data-toggle="dropdown" aria-expanded="false">
                             Navbar
                        </button>

    <!--    Navbar settings      -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <button id="autoscroll" class="set dropdown-item list-group-item-action fas fa-check" value="autoscroll">Autoscroll</button>
                                <button id="autohide" class="set dropdown-item list-group-item-action" value="autohide">Autohide</button>
                                <button id="cursor" class="set dropdown-item list-group-item-action" value="secret">Secret setting :)</button>
                        </div>
                    </li>

    <!--    Uitlog knop         -->
                    <li class="nav-item">
                        <button id="logout" type="button" class="btn btn-info btn-custom">Log uit</button>
                    </li>
                </ul>
            </nav>
        </nav>

<!--Logout warning modal-->
    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalLogOut">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" ><h4> Uitloggen <i class="fa fa-lock"></i></h4></div>
                <div class="modal-body"><i class="fa fa-question-circle"></i> Weet u zeker dat u wilt uitloggen?</div>
                <div class="modal-footer"><a href="javascript:void(0);" id="logoutBut" class="btn btn-primary btn-block">Uitloggen</a></div>
            </div>
        </div>
    </div>

<!--Logout confirmation-->
    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="logoutPopup">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body alert-light" style="text-align: center">Uitgelogd!</div>
            </div>
        </div>
    </div>

<!--  Hier wordt de content van de geklikte link weergegeven   -->
    <div id="content" style="">
        <div id="sticky" class="row text-left d-flex align-items-center sticky-top">
            <div class="col-lg-3 btn text-left s">ID nummer incident</div>
            <div class="col-lg-3 btn text-left s">Datum aanmelding</div>
            <div class="col-lg-3 btn text-left s">Looptijd incident</div>
            <div class="col-lg-3 btn text-left s">Wordt behandeld door</div>
        </div>
        <div id="accordion">
            <!--  Overzicht van incidenten, wordt altijd als eerste geladen als je deze programma opstart      -->
            <?php displayResult($row);?>
        </div>
    </div>
    <?php
    // Incdient form modal
    include "modal.php";

    ?>
    </body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src="contentLoader.js"></script>

</html>

<?php