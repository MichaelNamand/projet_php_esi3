<?php

include '../connexion.php';
session_start();
if ($_POST['username']) {
    $res = $db->prepare("SELECT * from etudiants");
    $res->execute();
    $user = 'error';
    while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) {
        // Version 2
        if ($ligne['login'] == $_POST['username']) {
            if (strval($ligne['motDePasse']) == strval($_POST['password'])) {
                $user = $ligne;
            }
        }
    }
    $_SESSION['user'] = $user;
    echo json_encode($user);
} else {
    echo 'error';
}


?>