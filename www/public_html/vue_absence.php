<div class="col-md-10 ">
    <div class="blockCombox">
        <div class="row selection">
            <div class="col-xs-3">
                <label>Departement : </label><br>
                <select id="dept">
                    <option value='null'>Choisir département</option>
                    <?php
                    include 'DAO/DAODepartement.php';
                    $var = json_decode(selectDepartement());

                    foreach ($var as $ligne) {
                        echo'<option value=' . $ligne[0] . '>' . $ligne[1] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Filière : </label><br>
                <select id="filiere">
                    <option value="">Choisir filière</option>
                    <option value="">azertyuiop</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Groupe : </label><br>
                <select id="grp">
                    <option value="">Choisir groupe</option>
                    <option value="">--Please choose an option--</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Departement : </label><br>
                <select>
                    <option value="">groupe</option>
                    <option value="">--Please choose an option--</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
        </div>
    </div>
    <div class='blockTable'>

        <table class='table table-striped'>
            <thead>
                <tr class='nomCol'>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Date</td>
                    <td>Matière</td>
                    <td>Absent</td>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 1; $i <= 50; $i++) {
                    ?>
                    <tr>
                        <td>Nom</td>
                        <td>Prénom</td>
                        <td>Date</td>
                        <td>Matière</td>
                        <td> <input type="checkbox" /></td>
                    </tr>
                <?php } ?>    
            </tbody>
        </table>
        <a href="#" class="btn valid">Valider</a>
    </div>
</div>