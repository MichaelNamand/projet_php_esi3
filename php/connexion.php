<?php
// Déclaration des variables
// nécessaires à la connexion

//header('content-type: text/html; charset=utf_8');
try{

    $db= new PDO('mysql:dbname=questionnaire;host=localhost', 'root','root');

}
catch(PDOException $e){

    echo'Connexion échouée !'.$e->getMessage();

}


?>