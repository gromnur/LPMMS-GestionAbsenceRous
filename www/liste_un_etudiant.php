<?php
include 'SecureSession.php';
?>
<div class="col-md-10 ">

    <div class="blockCombox">
        <span class="titrePage">Liste des absences d'un étudiant</span>

        <div class="row selection">

            <div class="col-xs-4">
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
            <div class="col-xs-4">
                <label>Filière : </label><br>
                <select id="filiereCombox">
                    <option value="null">Choisir filière</option>

                </select>
            </div>
            <div class="col-xs-4">
                <label>Groupe : </label><br>
                <select id="groupeCombox">
                    <option value="null">Choisir groupe</option>

                </select>
            </div>
            <div class="col-xs-4">
                <label>Étudiant : </label><br>
                <select id="etudiantCombox">
                    <option value="null">Choisir étudiant</option>

                </select>
            </div>
            <div class="col-xs-4">
                <label>Date : </label><br>
                <select id="dateCombox">
                    <option value="null">Choisir date</option>

                </select>
            </div>
            <div class="col-xs-4">
                <label>Matière : </label><br>
                <select id="matiereCombox">
                    <option value="null">Choisir matière</option>
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
                        <th id="date" class="sortTable">Date Début</th>
                        <th>Date Fin</th>
                        <th>Justifié</th>
                        <!--ajout d'une colonne justification si administratif-->
                    </tr>
                </thead>
                <tbody id="tbodyAbsEtud">
                   

                </tbody>
            </table>
        </div>
    </div>
</div>


