<div class="blockFormCrea">
    <span>Création d'un personnel</span>
    <form method="post" action="index.php?include=personnel" id='formCreaPerso'>
        <table class='tableCrea'>
            <tr>
                <td><label>Nom : </label></td>
                <td><input type='text' name='nomCreaPerso' placeholder="Entrer le nom" id='nomCreaPerso'/></td>
            </tr>
            <tr>
                <td><label>Prénom : </label></td>
                <td><input type='text' name='prenomCreaPerso' placeholder="Entrer le prénom" id="prenomCreaPerso"/></td>
            </tr>
            <tr>
                <td><label>Identifiant : </label></td>
                <td><input type='text' name='identifiantCreaPerso' placeholder="Entrer l'identifiant de connexion" id="idCreaPerso" /></td>
            </tr>
            <tr>
                <td><label>Mot de passe : </label></td>
                <td><input type='password' name='mdpCreaPerso' placeholder="Entrer le mot de passe" id="mdpCreaPerso" /></td>
            </tr>
            <tr>
                <td> <label>Type de personnel</label></td>
                <td><select name='choixCreaPerso' id="selectCrea">
                        <option value='null'>Choisir </option>
                        <option value='1'>Professeur</option>
                        <option value='0'>Administratif</option>
                    </select></td>
            </tr>
            <tr id="comboxDeptCreaPerso">
                <td> <label>Département</label></td>
                <td>
                    <select>
                        <option value='null'></option>
                        <?php
                        $var = selectDepartement();

                        foreach ($var as $ligne) {
                            echo'<option value=' . $ligne["id_departement"] . '>' . $ligne["libelle"] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr id="comboxFilCreaPerso">
                <td> <label>Filière</label></td>
                <td>
                    <select id="filiereComboxCreaPerso" name="filiereCreaPerso">
                        <option value="null"></option>

                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" class="btn valid" value="Créer"/>
    </form>
</div>

