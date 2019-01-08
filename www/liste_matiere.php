<?php
include 'SecureSession.php';
?>
<div class="col-md-10 ">

    <div class="blockCombox">
        <span class="titrePage">Liste des Matières</span>

        <div class="row selection">

            <div class="col-xs-6">
                <label>Département : </label><br>
                <select id="deptCombox">
                    <option value='null'>Choisir département</option>
                    <?php
                    $var = selectDepartement();

                    foreach ($var as $ligne) {
                        echo'<option value=' . $ligne["id_departement"] . '>' . $ligne["libelle"] . '</option>';
                    }
                    ?>
                </select>

            </div>
            <div class="col-xs-6">
                <label>Filière : </label><br>
                <select id="filiereCombox">
                    <option value="null">Choisir filière</option>

                </select>
            </div>
        </div>
    </div>
    <div class='blockTable'>
        <div class='scroll'>

            <table class='table table-striped' id="latable">
                <thead>
                    <tr class='nomCol'>
                        <th id="matiere" class="sortTable">Matière</th>
                    </tr>
                </thead>
                <tbody id="tbodyMatiere">
                </tbody>
            </table>
        </div>
    </div>
</div>


