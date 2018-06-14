<div id="sticky2" class="sticky-top">
    <table id="rapportageForm">
        <tbody>
        <tr>
            <td>
                Datum: <input type="text" name="datum" id="datum" placeholder="van jjjj-mm-dd">&emsp;<input type="text" name="einddatum" id="einddatum" placeholder="tot jjjj-mm-dd">&emsp;
                Incident:
                <select name="incident" id="incident">
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
            </td>
        </tr>
        </tbody>
    </table>
    <table class="table" id="testData">
        <thead class="table-bordered headerIncident">
        <tr>
            <th width="10%" class="btn-warning">Incident ID</th>
            <th width="30%" class="btn-warning">Datum Aanmelding</th>
            <th width="30%" class="btn-warning">Looptijd incident in dagen</th>
            <th width="30%" class="btn-warning">Naam klant</th>
        </tr>
        </thead>
    </table>
</div>