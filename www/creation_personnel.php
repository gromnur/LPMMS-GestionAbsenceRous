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
                        <option value='professeur'>Professeur</option>
                        <option value='administratif'>Administratif</option>
                    </select></td>
            </tr>
        </table>
        <input type="submit" class="btn valid" value="Créer"/>
    </form>
</div>

