<?php
include "../config.php";
?>

<div style="padding-top: 5px">

</div>
<form id="rapporatgeForm" class="change">
    Datum: <input type="text" name="datum" id="datum" placeholder="van jjjj-mm-dd">&emsp;<input type="text" name="einddatum" id="einddatum" placeholder="tot jjjj-mm-dd">&emsp;
    Incident:
    <select name="incident" id="incident" label=" ">
        <option value="alles">alles</option>
        <option value="open">open</option>                
        <option value="gesloten">gesloten</option> 
    </select>
    Soort incident:
    <select name="soortincident" id="soortincident">
        <option value="alles">alles</option>
        <option value="software">software</option>
        <option value="hardware">hardware</option>                
        <option value="advies">advies</option>
        <option value="verzoek">verzoek</option>
    </select>
    Type klant:
    <select name="typeklant" id="typeklant">
        <option value="alles">alles</option>
        <option value="student">student</option>
        <option value="docent">docent</option>                
        <option value="extern">extern</option>
    </select>
    &emsp;Baliemedewerker: <input type="text" name="baliemedewerker" id="baliemedewerker">
    &emsp;Behandelaar: <input type="text" name="behandelaar" id="behandelaar">
    <br><br><input type="submit" id="submitRapport">
</form>
<table class="table" id="rapportTable">
    <thead>
        <tr>
            <?php
            get_rapport($db);
            ?>
        </tr>
    </thead>
</table>
    <div id="result">
            
    </div>
<?php