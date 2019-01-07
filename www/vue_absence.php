<?php
include 'SecureSession.php';
?>
<div class="col-md-10 ">

    <div class="blockCombox">
        <span class="titrePage">Gestion des absences des étudiants</span>

        <div class="row selection">
            <div class="col-xs-4">
                <label>Departement : </label><br>
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
                <select id="groupeComboxAbs">
                    <option value="null">Choisir groupe</option>

                </select>
            </div>
            <br>
            <div class="col-xs-6">
                <label>Matière : </label><br>
                <select id="matiereComboxAbs">
                    <option value="null">Choisir matière</option>

                </select>
            </div>
            <div class="col-xs-6">
                <label>Date/Heure : </label><br>
                <select id="dateComboxAbs">
                    <option value='null'>Choisir date</option>
                </select>
            </div>
        </div>
    </div>
    <?php
    function letest() {
        // Verifier si le libelle n'est pas present
        // Creation d'un departement
        // récupération accés base de données
        $bd = getConnexion();

        if (isset($_POST["test"])) {
            $tableau = $_POST["test"];

            foreach ($_POST['test'] as $libelle) {
                $rqt = "INSERT INTO departement(libelle) VALUES (:libelle)";
                $stmt = $bd->prepare($rqt);
                // ajout param
                $stmt->bindParam(":libelle", $libelle);
                // execution requette
                $stmt->execute();
                // renvoi le libelle généré
            }
        }
    }
    ?>
    <div class='blockTable'>
        <div class='scroll'>
            <form method="post" id="formAbs" action="index.php?include=absenceEtudiant">
                <table class='table table-striped' id="latable">
                    <thead>
                        <tr class='nomCol'>
                            <th id="nom" class="sortTable">Nom</th>
                            <th id="prenom" class="sortTable">Prénom</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyListeEtudiantsAbs">
                  
                    </tbody>
<!--                     <tr>
                            <td>wxzfvb</td>
                            <td>sahh</td>
                            <td>Date</td>
                            <td> <input name="test[]" type="checkbox" value="" /></td>
                        </tr>-->
                </table>
                <input type="submit" class="btn valid" value="Valider"/>
            </form>
        </div>
    </div>
</div>


