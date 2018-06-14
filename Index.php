<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Style/bootstrap.min.css">
    <link rel="stylesheet" href="Style/Select2.css">
    <link rel="stylesheet" href="fontawesome-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="Style/style.css">
    <link href="Style/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />

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

    </div>
    <?php   // Incdient form modal
     include "modal.php";
    ?>
    </body>



<!--JQuery main library-->
<script src="Scripts/jquery-3.3.1.slim.js"></script>

<!--Popper,js plugin for bootstrap-->
<script src="Scripts/popper.js"></script>

<!--Select2 plugin for better dropdown menu-->
<script src="Scripts/select2.js"></script>

<!--Datatables plugin for better table search and sort functions-->
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<!--Bootstrap script library-->
<script src="Scripts/bootstrap.min.js"></script>

<!--Main script of this app-->
<script src="Scripts/contentLoader.js"></script>

<!--Pnotify plugin-->
<script type="text/javascript" src="Scripts/pnotify.custom.min.js"></script>

</html>

<?php