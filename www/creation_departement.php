<?php
include 'SecureSession.php';

if ($_SESSION['type'] == 2) {
    header('Location: index.php');
}
?>

<div class="blockFormCrea">
    <span>Création d'un département</span>
    <form method="post" action="index.php?include=dept" >
        <table class='tableCrea'>
            <tr>
                <td><label>Nom : </label></td>
                <td><input type='text' name='nomCreaDept' placeholder="Entrer le nom" id='nomCreaDept'/></td>
            </tr>
        </table>
        <input type="submit" class="btn valid" value="Créer"/>
    </form>
    <?php
    if (isset($resultat)) {
        if ($resultat == 0) {
            ?>
            <span class="errorCrea">Échec de la création</span>
            <?php
        } else {
            ?>
            <span class="successCrea">Création réussi</span>

            <?php
        }
    }
    ?>
</div>
