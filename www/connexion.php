<?php
session_start();

include 'DAOFactory.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gestion des absences</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/cssIHM.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <?php
        if (isset($_POST['identifiantCo']) && isset($_POST['mdpCo'])) {

            $id = htmlspecialchars($_POST['identifiantCo']);
            $mdp = htmlspecialchars($_POST['mdpCo']);
            $result = verifMDP($id, $mdp);
            if (count($result) == 0) {
                echo '<span class="erreurCo">Identifiant ou Mot de passe incorrect</span>';
            } else {
                $_SESSION['nom'] = $result[0];
                $_SESSION['prenom'] = $result[1];
                $_SESSION['numeropersonnel'] = $result[2];
                header('Location: http://127.0.0.1/public_html/index.php');
            }
        }
        ?>   
        <div class="blockConnexion">
            <div class="divBackground">
                <span>CONNEXION</span>
                <form method="post" action="connexion.php" id='formCo'>
                    <label>Identifiant</label>
                    <br>
                    <input type="text" name="identifiantCo" id='idCo'/>
                    <br>
                    <label>Mot de passe</label>        
                    <br>
                    <input type="password" name="mdpCo" id='mdpCo' />
                    <br>
                    <input type="submit" class="btnCo" value="Se connecter" />
                </form>
            </div>
        </div>

        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
    </body>
</html>
