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
    default:
        //function not found, error or something
        break;
}

?>
