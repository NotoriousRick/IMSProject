<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form id="form">
            Datum: <input type="text" name="datum" id="datum" placeholder="jjjj-mm-dd van">&emsp;<input type="text" name="einddatum" id="einddatum" placeholder="jjjj-mm-dd tot">&emsp;
            Incident:
            <select name="incident" id="incident" label=" ">
                <option disabled selected value style="display:none"></option>
                <option value="alles">alles</option>
                <option value="open">open</option>                
                <option value="gesloten">gesloten</option> 
            </select>
            Soort incident:
            <select name="soortincident" id="soortincident">
                <option disabled selected value style="display:none"></option>
                <option value="software">software</option>
                <option value="hardware">hardware</option>                
                <option value="advies">advies</option>
                <option value="verzoek">verzoek</option>
                <option value="alles">alles</option>
            </select>
            Type klant:
            <select name="typeklant" id="typeklant">
                <option disabled selected value style="display:none"></option>
                <option value="student">student</option>
                <option value="docent">docent</option>                
                <option value="extern">extern</option>
                <option value="alles">alles</option>
            </select>
            &emsp;Baliemedewerker: <input type="text" name="baliemedewerker" id="baliemedewerker">
            &emsp;Behandelaar: <input type="text" name="behandelaar" id="behandelaar">
            <br><br><input type="submit" id="submit">
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('#form').submit(function(e){
                e.preventDefault();
                $('#content').empty();
                var datum = $('#datum').val();
                var einddatum = $('#einddatum').val();
                var incident = $('#incident').val();
                var soortincident = $('#soortincident').val();
                var typeklant = $('#typeklant').val();
                var baliemedewerker = $('#baliemedewerker').val();
                var behandelaar = $('#behandelaar').val();
                $.ajax({
                    url: "Result.php",
                    type: "post",
                    data: {datum: datum, einddatum: einddatum, incident: incident, soortincident: soortincident, typeklant: typeklant, baliemedewerker: baliemedewerker, behandelaar: behandelaar},
                    success: function(response){
                        //console.log(response);
                        if (response === 0){
                            alert('error');
                        }
                        $('#content').append(response);
//                        $('#form').each(function(){
//                            this.reset();
//                        });
                    }
                  
                });
            });
        });
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        };

       //query moet werken voor datum, typeklant, soortincident, baliemedewerker, behandelaar, sluitdatum en totaalincident
        </script>
        <div id="content">
            
        </div>
    </body>
</html>