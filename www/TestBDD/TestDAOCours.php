<?php

require('../DAOFactory.php');

$date_incorect = "fes zfqsd";
$date_deb = "2018-05-15 10:00:00";
$date_fin = "2018-05-15 12:00:00";

/*
 * Test date valide
 */
echo "Test date valide : ";
if(isExistedate($date_deb)) {
    echo "Valide <br>";
} else {
    echo "Invalide <br>";
}

/*
 * Test date valide
 */
echo "Test date valide : ";
if(isExistedate($date_fin)) {
    echo "Valide <br>";
} else {
    echo "Invalide <br>";
}

/*
 * Test date invalide
 */
echo "Test date valide : ";
if(isExistedate($date_incorect)) {
    echo "Valide <br>";
} else {
    echo "Invalide <br>";
}

 ?>
