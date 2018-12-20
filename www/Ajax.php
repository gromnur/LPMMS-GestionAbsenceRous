<?php

require('DAOFactory.php');

// fonction sans parmetre
if (isset($_GET["fonction"])) {
    $fonction = $_GET["fonction"];

    if ($fonction == 'selectDepartement') {
        echo selectDepartement();
    }
}

?>
