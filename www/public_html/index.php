<?php
session_start();
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
        <!-- debut nav bar  -->
        <nav class=" navbar navbar-light bg-light justify-content-between">
            <div class="container-fluid ">
                <div class="row titreNav">
                    <div class=" col-md-10 titre">
                        Gestion des absences
                    </div>
                    <div class="col-md-2">
                        Utilisateur
                    </div>
                </div>
            </div>
        </nav>
        <!-- fin nav bar -->
        <div class="container-fluid selection">
            <div class="row">
                <div class="col-md-2 blockmenu">
                    <ul class="menu">
                        <li class="liste">Liste : 
                            <ul>
                                <li>Liste 1</li>
                                <li>Liste 2</li>
                                <li>Liste 3</li>
                                <li>Liste 4</li>
                            </ul>
                        </li>
                        <HR width="120%">
                        <li class="liste">Absence : 
                            <ul>
                                <li>absence 1</li>
                                <li>absence 2</li>
                                <li>absence 3</li>
                            </ul>
                        </li>
                        <HR width="120%">
                        <li class="liste">Absence : 
                            <ul>
                                <li>absence 1</li>
                                <li>absence 2</li>
                                <li>absence 3</li>
                            </ul>
                        </li>                
                        <HR width="120%">
                        <li class="liste">Absence : 
                            <ul>
                                <li>absence 1</li>
                                <li>absence 2</li>
                                <li>absence 3</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php
                include 'vue_absence.php';
                ?>
            </div>
        </div>

        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
    </body>
</html>
