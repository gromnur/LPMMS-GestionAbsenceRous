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
                    <option value="null">Choisir filière</option>

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
            <form method="post" action="<?php letest(); ?>">
                <table class='table table-striped' id="latable">
                    <thead>
                        <tr class='nomCol'>
                            <th id="nom" class="sortTable">Nom</th>
                            <th id="prenom" class="sortTable">Prénom</th>
                            <th>Date</th>
                            <th>Matière</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
//                        for ($i = 1; $i <= 50; $i++) {
                            ?>
                            <tr>
                                <td>azertyui</td>
                                <td>bqdfvr</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                            <tr>
                                <td>qsdgerv</td>
                                <td>prébtrsnom</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                            <tr>
                                <td>plizvnn</td>
                                <td>shycne</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                            <tr>
                                <td>lebontest</td>
                                <td>testlebon</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                            <tr>
                                <td>ohelsef</td>
                                <td>prénom</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                            <tr>
                                <td>nom</td>
                                <td>pqbzycw</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                            <tr>
                                <td>wxzfvb</td>
                                <td>sahh</td>
                                <td>Date</td>
                                <td>Matière</td>
                                <td> <input name="test[]" type="checkbox" value="<?php // echo $i ?>" /></td>
                            </tr>
                        <?php // } ?>  
                    </tbody>
                </table>
                <input type="submit" class="btn valid" value="Valider"/>
            </form>
        </div>
    </div>
</div>


