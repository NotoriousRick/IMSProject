// Main content container
var content = "#content"; // Content div for generated ajax content
var modal = "#modal"; // Content div for form modals
var main = "#main";
var form = $('#formulier');
var fmodal = $('#fModal');
// DataTables custom search
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[3] ) || 0; // use data for the age column

        if ( ( isNaN( min ) && isNaN( max ) ) ||
            ( isNaN( min ) && age <= max ) ||
            ( min <= age   && isNaN( max ) ) ||
            ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$('.select_two').select2({
    placeholder: "*"
});

// Datatable initialization for incident list
function initTable(source) {
     return $('#testData').DataTable({
         retrieve: true,
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

// Datatable for rapportages page
function initRapport() {

        return table = $('#testData').DataTable({
            retrieve: true,
            "ajax": "Pim/Result.php",
            "columns": [
                {"data": "Incident_ID"},
                {"data": "Datum"},
                {"data": "duration"},
                {"data": "Naam"}
            ],
            "order": [[1, "asc"]],
            "createdRow": function (row, data) {
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

// Pnotify validation
function newIncidentCheck(){
    var forms_input = document.forms["formulier"].querySelectorAll("input, textarea, select");
    var empty_required_columns = '';
    var j = 0;
    $(forms_input).each(function(i, field) {
        if (field.name === 'ID_Nummer' || field.name === 'UitgevoerdeWerkzaamheden' ||
            field.name === 'Afspraken' || field.name === 'GereedVoorSluiten1' ||
            field.name === 'GereedVoorSluiten2' || field.name === 'SluitDatum' ||
            field.name === 'VervolgActie' || field.name === 'Datum' || field.name === 'Incident_ID') {
            // do nothing hu?
        }
        else if (field.value === '') {
            field.style.borderColor = 'red';
            empty_required_columns += field.name + '<br />';
            j += 1;
        }
        else {
            field.style.borderColor = '';
        }
    });

    if (j > 0)
    {
        $(function () {
            new PNotify({
                title: 'Verplichte velden',
                text: empty_required_columns,
                type: 'error'
            })
        })
    }
}

var table = initTable("get_incident_data.php");

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

// Add modal event to the table cell (display the modal on click)
$(content).on('click', 'tbody > tr > td', function (){
    // Get incident form id from database
    if($(modal).hasClass('submit')){
        $(modal).removeClass('submit').addClass('edit');
    }
    var id = table.row(this).id();
    var incidentID = id.replace('id', '');
    var form = $('#fModal');

    // Fill in the form with data
    $.getJSON({
        url: 'get_form_data.php',
        method: 'post',
        data: {id: incidentID},
        success: function (response) {
            $.each(response, function(name, value){
                console.log(response['Type_ID']);
                var selector = $('[name="'+name+'"]');
                var type = $('[name="'+name+'"]').attr('type');
                if (selector.hasClass('select_two')){
                   $('[name="TypeKlant"]').val(response['Type_ID']).trigger("change");
                   $('[name="SoortIncident"]').val(response['SoortIncident_ID']).trigger("change");
                    // form.find($('[name='+name+'] option')).filter(function() {
                    //     return ($(this).text() == value);
                    // }).prop('selected', true).trigger("change");
                }
                else if(selector.is(':checkbox')){
                    if (value == 1) form.find($('[value='+name+']')).prop('checked', true)
                }
                else {
                    if (value === "0000-00-00"){
                        form.find(selector).val(' ')
                    }
                    else
                        form.find(selector).val(value)
                }
            })
        }
    });

    form.modal('show');
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

// Navbar settings button
$(document).ready(function () {
    $('.set').click(function () {

        // newIncidentCheck if we need to disable or enable the setting
        // fas fa-newIncidentCheck is a class attribute for checkbox checked sign and is also used to see if the setting is enabled or disabled
        if($(this).hasClass('fas fa-check')){

            // disable the setting
            $(this).removeClass('fas fa-check');

            // newIncidentCheck what setting to disable
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

            // newIncidentCheck what setting to enable
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
        url: 'logout.php',
        method: 'post',
        success: function () {

            // Show and hide the logout modal on success
            $('#logoutPopup').modal('show');
            setTimeout(function() {
                $('#logoutPopup').modal('hide');
            }, 1000);

            // After short delay, redirect to log-in page
            setTimeout(function() {
                window.location = 'login.php'
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

// New incident registration page
$(document).ready(function(){

    // Load the page
    $('#incident').click( function(e){
        $('#TypeKlant').val('').trigger('change');
        $('#SoortIncident').val('').trigger('change');
        form[0].reset();
        $(modal).removeClass('edit').addClass('submit');
        fmodal.modal('show');

        // Show or hide the right fields
        fmodal.on('change', '.TypeKlant', function () {
            var value = $('.TypeKlant').val();
            var type_klant_value = value;
            if (type_klant_value == 1 || type_klant_value == 2)
            {
                $('.id_number').show();
            }
            else
            {
                $('.id_number').val("");
                $('.id_number').hide();
            }
        });
    })
});

// Form submit
$('#fModal').on('submit', '#formulier', function (e) {

    var formdata = form.serialize();
    var id = $('[name="Incident_ID"]');
    if (!newIncidentCheck()){
        e.preventDefault();
        return;
    }
    if($('.TypeKlant option' ).filter(':selected').text() !== "Extern")
    {
        if($('[name="ID_Nummer"]').val() === ""){
            $(function () {
                new PNotify({
                    title: 'Attentie',
                    text: 'Vul alstublieft de ID Nummer in',
                    type: 'warning'
                });
            });
            e.preventDefault();
            return;
        }
    }
    if ($(modal).hasClass('submit')){ // register new incident
        $.ajax({
            type: "post",
            url: "incident_submission.php",
            data: formdata,
            success: function(response)
            {
                alert('new incident submitted!');
                console.log(formdata);
                console.log(response);
            }
        });
    }
    else if($(modal).hasClass('edit')){ // edit existing incident
        $.ajax({
            type: "post",
            url: "edit_incident.php",
            data: formdata, Incident_ID:id,
            success: function(response)
            {
                console.log(formdata);
                if (response === "noice"){
                    alert('incident edited!');
                }
                else{
                    alert('something went wrong');
                }
            }
        });

    }
    e.preventDefault();
});

// Show or hide the right fields on modal
$(form).on('change', '.TypeKlant', function () {
    var value = $('.TypeKlant').val();
    var type_klant_value = value;
    if (type_klant_value == 1 || type_klant_value == 2)
    {
        $('.id_number').show();
    }
    else
    {
        $('.id_number').val("");
        $('.id_number').hide();
    }
});

// Rapportages page
$(document).ready(function(){

    // Load the initial UI on click
    $('#rapport').on('click',function() {
        $(content).empty();
        $.ajax({
            url: 'Pim/rapportages.php',
            type: 'get',
            success: function (response) {
                if (response == null) {
                    alert('error');
                }
                $(content).append(response);
                if ($('#autoscroll').hasClass('fas fa-check')) {
                    $('.change').css('padding-top', '64px');
                }

                // Load the table
                $.ajax({
                    url: 'overzicht_rapport.php',
                    type: 'get',
                    success: function (response) {
                        if (response == null) {
                            alert('error');
                        }
                        $(content).append(response);
                        $(content).css('padding', '0');

                        if (!$('#autoscroll').hasClass('fas fa-check')) {
                            $('#sticky2').removeClass('sticky-top').css('padding-top','8px');
                        }

                        // Load the data for the table
                        initRapport();

                        // Custom filter options trigger
                        $('#min, #max').on('keyup', function() {
                            table.draw();
                        } );
                    }
                });
            }
        });
    });
});

//Admin knop
$(document).ready(function () {
    $('#admin').click(function () {
        $(content).empty();
        $.ajax({
            url: 'UserOverzicht.php',
            type: 'get',
            success: function (response) {
                if (response == null) {
                    alert('error');
                }
                $(content).append(response);
                $(content).css('padding', '0');

                // Check the state of the navbar settings
                if (!$('#autoscroll').hasClass('fas fa-check')) {
                    $('#sticky2').removeClass('sticky-top').css('padding-top', '8px');
                }
            }
        });
        $(content).off('click', ".btn-warning, .btn-danger, .btn-outline-info");
    });
});
