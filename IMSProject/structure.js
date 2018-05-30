var content = "#content";

//checkbox
// function display(){
//     if($("#check").is(':checked'))
//         $(sqlShow).show();
//     else
//         $(sqlShow).hide();
// }

// toggle button
// $(toggler).on('click', function() {
//     if ($(toggler).attr('value') === "show") {
//         $(sqlShow).show();
//         $(toggler).prop("value", "hide");
//     } else {
//         $(sqlShow).hide();
//         $(toggler).prop("value", "show");
//     }
//
// });

// Uitlog knop
$(document).ready(function(){
    $('#logout').click(function(){
        alert('Uitgelogd!');
    })
});

// Overzicht incidenten
$(document).ready(function(){
    $('#overzicht').click(function(){
        $(content).empty();
        $.ajax({
            url: 'overzicht_incidenten.php',
            type: 'post',
            success: function (response) {
                if (response == null){
                    alert('error');
                }
                $(content).append(response);
            }
        });
    })
});

// Nieuw incident melden
$(document).ready(function(){
    $('#incident').click(function(){
        $(content).empty();
        $.ajax({
            url: 'incident_formulier.php',
            type: 'post',
            success: function (response) {
                if (response == null){
                    alert('error');
                }
                $(content).append(response);
            }
        });
    })
});

// Rapportages
$(document).ready(function(){
    $('#rapport').click(function(){
        $(content).empty();
        $.ajax({
            url: 'rapportages.php',
            type: 'post',
            success: function (response) {
                if (response == null){
                    alert('error');
                }
                $(content).append(response);
            }
        });
    })
});

