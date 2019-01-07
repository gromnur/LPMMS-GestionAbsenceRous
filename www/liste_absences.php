<?php
include 'SecureSession.php';
?>

<div class="col-md-10 ">
    <div class="blockCombox">
        <span class="titrePage">Liste des absences des étudiants</span>

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
                <select id="filiereComboxListeAbs">
                    <option value="null">Choisir filière</option>

                </select>
            </div>
            <div class="col-xs-4">
                <label>Groupe : </label><br>
                <select id="groupeComboxListeAbs">
                    <option value="null">Choisir groupe</option>

                </select>
            </div>
        </div>
    </div>
    <div class='blockTable'>
        <div class='scroll'>
            <table class='table table-striped' id="latable">
                <thead>
                    <tr class='nomCol'>
                        <th id="ine" class="sortTable">INE</th>
                        <th id="nom" class="sortTable">Nom</th>
                        <th id="prenom" class="sortTable">Prénom</th>
                        <th id="matiere" class="sortTable">Matière</th>
                        <th id="date" class="sortTable">Date début</th>
                        <th id="dateFin" class="sortTable">Date fin</th>
                        <th>Justifié</th>
                        <!--ajout d'une colonne justification si administratif-->
                    </tr>
                </thead>
                <tbody id="tbodyListeAbsences">

                </tbody>
            </table>
        </div>
    </div>
</div>


