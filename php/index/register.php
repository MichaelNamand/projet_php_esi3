<?php

include '../connexion.php';
session_start();
if ($_POST['username-register']) {

    $stmt = $db->prepare("INSERT INTO etudiants (login, motDePasse, nom, prenom, email) VALUES (:login, :motDePasse, :nom, :prenom, :email)");
    $stmt->bindParam(':login', $_POST['username-register']);
    $stmt->bindParam(':motDePasse', $_POST['password-register']);
    $stmt->bindParam(':nom', $_POST['fname-register']);
    $stmt->bindParam(':prenom', $_POST['lname-register']);
    $stmt->bindParam(':email', $_POST['email-register']);
    $result = $stmt->execute();
    if($result){
        //What you do here is up to you!
        echo 'Merci pour votre inscription ! Vous pouvez maintenant vous connecter avec vos identifiants.';
    } else { echo 'error';}

} else {
    echo 'error';
}


?>