<div class="blockFormCrea">
    <span>Création d'un filière</span>
    <form method="post" action="index.php?include=filiere" >
        <label>Département : </label>
        <select name="comboxDeptCreaFil" id="dept">
            <option value='null'>Choisir département</option>
            <?php
            $var = selectDepartement();

            foreach ($var as $ligne) {
                echo'<option value=' . $ligne["id_departement"] . '>' . $ligne["libelle"] . '</option>';
            }
            ?>
        </select>
        <table class='tableCrea'>
            <tr>
                <td><label>Nom :  &nbsp;</label></td>
                <td><input type='text' name='nomCreaFil' placeholder="Entrer le nom" id='nomCreaFil'/></td>
            </tr>
        </table>
        <input type="submit" class="btn valid" value="Créer"/>
    </form>
</div>
