<?php

if (isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['type'])) {
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $type = $_SESSION['type'];
} else {
    header('Location: deco.php');
    exit();
}

