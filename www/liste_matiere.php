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
    <?php
    /*
     * Créé un departement
     * Renvoi id_departement si inserer, 0 sinon
     */

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


