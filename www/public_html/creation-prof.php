<?php session_start();
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
                    <div class="visible-sm visible-xs col-xs-1  ">
                        <span class="btnmenu glyphicon glyphicon-th-list"></span>
                    </div>
                    <div class="col-xs-9 col-md-10 titre">
                        Gestion des absences
                    </div>
                    <div class="col-md-2">
                        Utilisateur
                    </div>
                </div>
            </div>
        </nav>
        <!-- fin nav bar -->
        <div class="container selection">
            <div class="col-xs-3">
                <label>Departement : </label>
                <select>
                    <option value="">departement</option>
                    <option value="">--Please choose an option--</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Departement : </label>
                <select>
                    <option value="">filiere</option>
                    <option value="">azertyuiop</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Departement : </label>
                <select>
                    <option value="">groupe</option>
                    <option value="">--Please choose an option--</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Departement : </label>
                <select>
                    <option value="">--Please choose an option--</option>
                    <option value="">--Please choose an option--</option>
                    <option value="">--Please choose an option--</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 hidden-sm hidden-xs">
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
            <div class="col-md-6 ">
                <div class="row">
                    <div class="col-xs-2"><label>Nom</label></div>
                    <div class="col-xs-2"><label>Prénom</label></div>
                    <div class="col-xs-2"><label>Absent</label></div>
                </div>
                <?php
                for ($i = 1; $i <= 50; $i++) {
                    ?>
                    <div class='row '>
                        <div class="col-xs-2 ligne">Nom</div>
                        <div class="col-xs-2 ligne">Prénom</div>
                        <div class="col-xs-2 ligne"> <input type="checkbox" /></div>
                    </div>
                <?php } ?>          
                <a href="#" class="btn valid">Valider</a>
            </div>
            <div class="col-xs-4"></div>
        </div>
    </body>
</html>
