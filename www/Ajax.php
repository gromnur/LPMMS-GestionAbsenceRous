<?php

require('DAOFactory.php');

//le switch sert de "routeur" et appelle la fonction demandé par l'appel ajax 
//en fonction du parametre passer en POST 'func'
$func = $_POST['func'];
switch ($func) {
    case 'selectFiliereByDept':
        $id = $_POST['param'];
        selectAvecDepartementFiliere($id);
        break;
    case 'selectGrpByFiliere':
        $id_filiere = $_POST['param'];
        selectAvecFiliereGroupeEtudiant($id_filiere);
        break;
    case 'selectEtudByGrpFil':
        $id_filiere = $_POST['paramFiliere'];
        $id_grp = $_POST['paramGrp'];
        selectAvecGroupeEtudiantEtudiant($id_grp, $id_filiere);
        break;
    case 'selectMatiereByFiliere':
        $id_filiere = $_POST['param'];
        selectMatiereWithFiliere($id_filiere);
        break;
    case 'selectDateByMatiereFilGrp':
        $id_matiere = $_POST['paramMatiere'];
        $id_filiere = $_POST['paramFil'];
        $libelle_groupe = $_POST['paramGrp'];
        selectWithGroupeEtudiantMatiereCours($id_filiere, $libelle_groupe, $id_matiere);
        break;
    case 'selectEtudByDate':
        $id_cours = $_POST['param'];
        selectWithCoursEtudiant($id_cours);
        break;
    case 'selectAbsByEtud':
        $abs = $_POST['param'];
        selectAvecEtudiantAbsence($abs);
        break;
    case 'selectAbsByGrpFil':
        $id_matiere = $_POST['paramGrp'];
        $id_filiere = $_POST['paramFil'];
        selectWithGroupeEtudiantAbsence($id_filiere, $id_matiere);
        break;
    case 'selectAbsByEtudMatiere':
        $id_matiere = $_POST['paramMat'];
        $ine = $_POST['paramEtud'];
        selectAvecEtudiantMatiereAbsence($ine, $id_matiere);
        break;
    default:
        //function not found, error or something
        break;
}
?>
