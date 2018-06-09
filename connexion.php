<?php
/**
 * @return PDO
 */
function connectDB() {
    $connexion = null;
    try {
        $connexion = new PDO('mysql:host=localhost;dbname=questionnaire', 'root'    , '');
    } catch (PDOException $e) {
        echo 'Échec lors de la connexion : ' . $e->getMessage();
    }
    return $connexion;
}

echo 'hello';

?>