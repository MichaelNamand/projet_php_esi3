<?php

include '../connexion.php';
session_start();
if ($_POST['username']) {
    $res = $db->prepare("SELECT * from etudiants");
    $res->execute();
    $users = array();
    $isValid['status'] = 'error';
    while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) {
        // Version 2
        if ($ligne['login'] == $_POST['username']) {
            if (strval($ligne['motDePasse']) == strval($_POST['password'])) {
                $isValid['status'] = $ligne;
            }
        }
    }
    echo json_encode($isValid);
} else {
    echo 'error';
}


?>