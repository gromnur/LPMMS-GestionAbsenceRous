<?php
session_start();
include 'SecureSession.php';

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
        <link rel="icon" type="image/png" href="logo.jpg" />
    </head>
    <body>
        <!-- debut nav bar  -->
        <nav class=" navbar navbar-light bg-light justify-content-between">
            <div class="container-fluid ">
                <div class="row titreNav">
                    <div class="col-xs-2">
                        <?php echo "Bonjour $nom"; ?>
                    </div>
                    <div class=" col-xs-8 titre">
                        <a href="index.php" class="nomSite">Gestion des absences</a>
                    </div>
                    <div class="col-xs-2">
                        <a href="deco.php" class="btn btnDeco">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- fin nav bar -->
        <div class="container-fluid selection">
            <div class="row">
                <div class="col-md-2 blockmenu">

                </div>
                <?php
                if (isset($_GET['include'])) {
                    if ($_GET['include'] == "personnel") {
                        include 'creation_personnel.php';
                    }
                    if ($_GET['include'] == "filiere") {
                        include 'creation_filiere.php';
                    }
                    if ($_GET['include'] == "dept") {
                        include 'creation_departement.php';
                    }
                    if ($_GET['include'] == "absenceEtudiant") {
                        include 'vue_absence.php';
                    }
                    if ($_GET['include'] == "matiere") {
                        include 'liste_matiere.php';
                    }
                    if ($_GET['include'] == "listeAbsEtud") {
                        include 'liste_un_etudiant.php';
                    }
                    if ($_GET['include'] == "etudiants") {
                        include 'liste_etudiants.php';
                    }
                    if ($_GET['include'] == "absences") {
                        include 'liste_absences.php';
                    }
                    if ($_GET['include'] == "suppressionFiliere") {
                        include 'suppression_filiere.php';
                    }
                    if ($_GET['include'] == "insertionEleve") {
                        include 'insertion_eleve.php';
                    }
                    if ($_GET['include'] == "insertionPlan") {
                        include 'insertion_planning.php';
                    }
                }else{
                    include 'accueil.php';
                }
                ?>
            </div>
        </div>
        <ul class="menu">
            <li class="liste">Liste :
                <ul>
                    <li><a href="index.php?include=matiere">Matières</a></li>
                    <li><a href="index.php?include=listeAbsEtud">Absence d'un étudiant</a></li>
                    <li><a href="index.php?include=etudiants">Etudiants</a></li>
                    <li><a href="index.php?include=absences">Absences</a></li>
                </ul>
            </li>
            <HR width="120%">
            <li class="liste">Absence :
                <ul>
                    <li><a href="index.php?include=absenceEtudiant">Absence Étudiant</a></li>
                </ul>
            </li>
            <?php
            if ($type != 2) {
                ?>
                <HR width="120%">
                <li class="liste">Créer
                    <ul>
                        <li><a href="index.php?include=filiere">Créer filière</a></li>
                        <li><a href="index.php?include=dept">Créer Département</a></li>
                        <li><a href="index.php?include=personnel">Créer Personnel</a></li>
                    </ul>
                </li>
                <HR width="120%">
                <li class="liste">Importation
                    <ul>
                        <li><a href="index.php?include=insertionEleve">Importer Élève (csv)</a></li>
                        <li><a href="index.php?include=insertionPlan">Importer plannings</a></li>
                        <li><a href="index.php?include=suppressionFiliere">Suppression filière</a></li>
                    </ul>
                </li>
                <?php
            }
            ?>
        </ul>

        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
    </body>
</html>
