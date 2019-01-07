<?php
include 'SecureSession.php';
?>

<div class="col-md-10 ">
    <div class="blockCombox">
        <span class="titrePage">Suppression des cours d'une filière</span>

        <div class="row selection">
            <form action="index.php?include=suppressionFiliere" method="post" name="formDeleteFil" id="formDeleteFil">
                <div class="col-xs-6">
                    <label>Département : </label><br>
                    <select name="deptDelet" id="deptCombox">
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
                    <select name="filDelete" id="filiereComboxListeAbs">
                        <option value="null">Choisir filière</option>

                    </select>
                </div>
                <br>
                <br>
                <br>
                <br>

                <label>De</label>&nbsp;&nbsp;&nbsp;&nbsp; <input name="dateMinDelete" id="date" type="date" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>à</label>&nbsp;&nbsp;&nbsp;&nbsp;  <input name="dateMaxDelete" type="date" />
                <input type="submit" value="Supprimer" class="btn valid"/>
            </form>
        </div>


    </div>

    <!--    <div class='blockTable'>
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
                            ajout d'une colonne justification si administratif
                        </tr>
                    </thead>
                    <tbody id="tbodyListeAbsences">
    
                    </tbody>
                </table>
            </div>
        </div>-->
</div>


