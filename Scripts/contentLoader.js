    // Unique id's description
// l+number = unique id for the inner form div
// id+number = unique id from the header div
// i+number = unique id from button group

// Main content container
var content = "#content"; // Content div for generated ajax content

// Datatable initialization for incident list
function initTable(source) {
     return $('#testData').DataTable({
        "ajax": source,
        "columns": [
            {"data": "incidentId"},
            {"data": "datum"},
            {"data": "duration"},
            {"data": "naam"}
        ],
        "order": [[1, "asc"]],
        "createdRow": function (row, data, index) {
            var days = data['days'];
            var color;
            if (days > 356) {
                color = 'btn-danger';
            } else if (days > 160) {
                color = 'btn-warning';
            } else {
                color = 'btn-outline-info';
            }
            $(row).addClass(color);
        },
        "language": {
            "sProcessing": "Bezig...",
            "sLengthMenu": "_MENU_ resultaten weergeven",
            "sZeroRecords": "Geen resultaten gevonden",
            "sInfo": "_START_ tot _END_ van _TOTAL_ resultaten",
            "sInfoEmpty": "Geen resultaten om weer te geven",
            "sInfoFiltered": " (gefilterd uit _MAX_ resultaten)",
            "sInfoPostFix": "",
            "sSearch": "Zoeken:",
            "sEmptyTable": "Geen resultaten aanwezig in de tabel",
            "sInfoThousands": ".",
            "sLoadingRecords": "Een moment geduld aub - bezig met laden...",
            "oPaginate": {
                "sFirst": "Eerste",
                "sLast": "Laatste",
                "sNext": "Volgende",
                "sPrevious": "Vorige"
            },
            "oAria": {
                "sSortAscending": ": activeer om kolom oplopend te sorteren",
                "sSortDescending": ": activeer om kolom aflopend te sorteren"
            }
        }
    });
}

var table = initTable("get_incident_data.php");
var rapport = initTable("Pim/Result.php");

// Initial page load
$(document).ready(function () {
    // $(content).empty();
    $.ajax({
        url: 'overzicht_incident.php',
        type: 'post',
        success: function (response) {
            if (response == null) {
                alert('error');
            }
            $(content).append(response);
            $(content).css('padding', '0');

            // Check the state of the navbar settings
            if (!$('#autoscroll').hasClass('fas fa-check')) {
                $('#sticky2').removeClass('sticky-top').css('padding-top','8px');
            }
           table = initTable("get_incident_data.php");
        }
    });
    $(content).off('click', ".btn-warning, .btn-danger, .btn-outline-info");
});

// Overzicht Incidenten DataTable
$(document).ready(function () {
    $('#overzicht').click(function () {
        $(content).empty();
        $.ajax({
            url: 'overzicht_incident.php',
            type: 'post',
            success: function (response) {
                if (response == null) {
                    alert('error');
                }
                $(content).append(response);
                $(content).css('padding', '0');

                // Check the state of the navbar settings
                if (!$('#autoscroll').hasClass('fas fa-check')) {
                    $('#sticky2').removeClass('sticky-top').css('padding-top','8px');
                }

                // DataTable initiation
                table =  initTable("get_incident_data.php");
            }
        });
        $(content).off('click', ".btn-warning, .btn-danger, .btn-outline-info");
    });
});

// DataTable event
$(content).on('click', 'tbody > tr > td', function (){

    // Get incident form id from database
    var id = table.row(this).id();
    var incidentID = id.replace('id', '');
    var form = $('#fModal');
    $.getJSON({
        url: 'get_form_data.php',
        method: 'post',
        data: {id: incidentID},
        success: function (response) {
            $.each(response, function(name, value){

                var type = $('[name="'+name+'"]').attr('type');
                if (type === 'select-one'){
                    form.find($('[name='+name+']')).val( value ).trigger("change");
                }
                else if($('[name="'+name+'"]').is(':checkbox')){
                    if (value == 1) form.find($('[value='+name+']')).prop('checked', true)
                }
                else {
                    if (value === "0000-00-00"){
                        form.find($('[name='+name+']')).val(' ')
                    }
                    else
                    form.find($('[name='+name+']')).val(value)
                }
            })
        }
    });
    form.modal('show');
});

// Form submit
$(content).on('submit', '#formulier', function (e) {
    var formdata = $("#formulier").serialize();
    $.ajax({
        type: "post",
        url: "incident_formulier.php",
        data: formdata,
        success: function(response)
        {
            console.log(formdata);
            console.log(response);
        }
    });
    e.preventDefault(); // prevent page reload
});

// When a button is clicked, it will have a different color until its clicked again
$(content).on('click', ".btn-warning, .btn-danger, .btn-outline-info", function () {

    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    }
    else {
        $(this).addClass('selected');
    }
});

// Prevent navbar settings dropdown collapsing back when a setting is clicked
$(".dropdown-menu").click(function(e){
    e.stopPropagation();
});

// Pre-load blank forms for index page
$(document).ready(function() {

    $.ajax({
        url: 'blank_form.php',
        method: 'post',
        success: function (response) {
            $('.incident-form').append(response);
            $('.VervolgActie').hide();
            // remove change class so that autoscroll function will ignore this div
            $('.change').removeClass('change');

            // disable inputs

        }
    });
});

// Fill in the form
$(content).on('click','.incident', function () {

    // Get incident form id from database
    var id = $(this).attr('id');
    var incidentID = id.replace('id', '');
    var form = $('#l' + incidentID);
    $.getJSON({
        url: 'get_form_data.php',
        method: 'post',
        data: {id: incidentID},
        success: function (response) {
            $.each(response, function(name, value){

                var type = $('[name="'+name+'"]').attr('type');
                if (type === 'select-one'){
                    form.find($('[name='+name+']')).val( value ).trigger("change");
                    // $('#'+form+' option').filter(function () { return $(this).html() === value; }).val(value)
                }
                else if($('[name="'+name+'"]').is(':checkbox')){
                  if (value == 1) form.find($('[value='+name+']')).prop('checked', true)
                }
                else {
                    form.find($('[name='+name+']')).val(value)
               }
            })
        }
    });
});

// Navbar settings button
$(document).ready(function () {
    $('.set').click(function () {

        // check if we need to disable or enable the setting
        // fas fa-check is a class attribute for checkbox checked sign and is also used to see if the setting is enabled or disabled
        if($(this).hasClass('fas fa-check')){

            // disable the setting
            $(this).removeClass('fas fa-check');

            // check what setting to disable
            if ($(this).attr('value') === "autoscroll"){
                $('.navbar-main').removeClass('fixed-top');
                $('#sticky').removeClass('sticky-top').css('padding-top', '6px');
                $('#sticky2').removeClass('sticky-top').css('padding-top', '8px');
                $('.change').css('padding-top', '11px');
                $('#collapsedNavbar').removeClass('sticky-top');
            }
            else if($(this).attr('value') === "secret"){
                $('.btn-outline-info, .btn-danger, .btn-warning').removeClass('ainsley');
            }
        }

        else{
            // enable the setting
            $(this).addClass('fas fa-check');

            // check what setting to enable
            // enable sticky navbars
            if ($(this).attr('value') === "autoscroll"){
                $('.navbar-main').addClass('fixed-top');
                $('#sticky').addClass('sticky-top').css('padding-top', '70px');
                $('#sticky2').addClass('sticky-top').css('padding-top', '72px');
                $('.change').css('padding-top', '75px');
            }

            // autohide the navbar to a small collapsed button
            else if($(this).attr('value') === "autohide"){
                $('.navbar').hide();

                // create the collapsed button
                $('#collapsedNavbar').append("<div id=\"toggle\" class=\"btn btn-info btn-custom btn-block\"></div>");
                $('#sticky').css('padding-top', '0');
                $('#sticky2').css('padding-top', '8px');
                $('.change').css('padding-top', '11px');
            }
            else if(($(this).attr('value') === "secret")){
                $('.btn-outline-info, .btn-danger, .btn-warning').addClass('ainsley');
            }
        }
    });
});

// Collapsed navbar button
$('#collapsedNavbar').on('click', '#toggle', function () {
    $('.navbar').show();
    $('#collapsedNavbar').empty();
    $('#autohide').removeClass('fas fa-check');

    // Adjust divs if autoscroll is enabled
    if ($('#autoscroll').hasClass('fas fa-check')){
        $('#sticky').css('padding-top', '70px');
        $('#sticky2').css('padding-top', '72px');
        $('#collapsedNavbar').addClass('sticky-top');
        $('.change').css('padding-top', '75px');
    }
});

// Logout button
$(document).on('click', '#logoutBut', function () {
    $('#modalLogOut').modal('hide');
    $.ajax({
        url: 'Jetske/logout.php',
        method: 'post',
        success: function () {

            // Show and hide the logout modal on success
            $('#logoutPopup').modal('show');
            setTimeout(function() {
                $('#logoutPopup').modal('hide');
            }, 1000);

            // After short delay, redirect to log-in page
            setTimeout(function() {
                window.location = window.location.href + 'Jetske/login.php'
            }, 1000);
        }
    });
});

// Display logout confirmation modal
$(document).ready(function(){
    $('#logout').click(function(){
        $('#modalLogOut').modal('show');
    })
});

// Overzicht incidenten features button
$(content).on("click", ".btn-right", function (e) {
    if(!e) {e = window.event; }
    e.stopPropagation();

    var id = this.id; // button id -> Depends on which incident the button was clicked
    var val = $(this).attr('value'); // button function id -> depends on  which one of the 4 buttons was clicked

    // assign what to do to id depending on the button value
    if (val === "b1") val = "Functie 1";
    else if(val === "b2")val = "Incident inzien";
    else if(val === "b3")val = "Formulier uitprinten";
    else if(val === "b4")val = "Incident afmelden";
    alert("button id: "+ id +" button function:  "+ val);
    //if (id);
});

// Nieuw incident melden page
$(document).ready(function(){

    // Load the page
    $('#incident').click(function(e){
        $(content).empty();
        $.ajax({
            url: 'incident_formulier.php',
            type:'get',
            success: function (response) {
                if (response == null){
                    alert('error');
                }
                $(content).append(response);
                // Hide stuff here
                $('#VervolgActie').hide();
                $('.id_number').hide();
                if($('#autoscroll').hasClass('fas fa-check')) {
                    $('.change').css('padding-top', '75px');
                }
            }
        });

        // Show or hide the right fields
        $(content).on('change', '.TypeKlant', function () {
            var value = $(this).val();
            var type_klant_value = value.replace('selected', '');
            if (type_klant_value == 1 || type_klant_value == 2)
            {
                $('.id_number').show();
            }
            else
            {
                $('.id_number').hide();
            }
        });
    })
});

// Rapportages page
$(document).ready(function(){

    // Load the initial UI on click
    $('#rapport').on('click',function() {
        $(content).empty();
        $.ajax({
            url: 'Pim/rapportages.php',
            type: 'post',
            success: function (response) {
                if (response == null) {
                    alert('error');
                }
                $(content).append(response);
                if ($('#autoscroll').hasClass('fas fa-check')) {
                    $('.change').css('padding-top', '64px');
                }

                $.ajax({
                    url: 'overzicht_incident.php',
                    type: 'post',
                    success: function (response) {
                        if (response == null) {
                            alert('error');
                        }
                        $(content).append(response);
                        $(content).css('padding', '0');

                        // Check the state of the navbar settings
                        if (!$('#autoscroll').hasClass('fas fa-check')) {
                            $('#sticky2').removeClass('sticky-top').css('padding-top','6px');
                        }
                         rapport = initTable("Pim/Result.php");
                    }
                });
            }
        });
    });
});

// Submit custom query
$(content).on('submit','#rapportageForm', function(e){

    var formdata = $("#rapportageForm").serialize();

    // Custom query submition
    $.ajax({
        url: "Pim/Result.php",
        type: "post",
        data: formdata,
        success: function(response){
            // rapport.clear();
            // rapport.rows.add(response).draw();
        }
    });
    e.preventDefault();
});
