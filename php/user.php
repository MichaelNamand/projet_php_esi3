<?php
require_once("connexion.php");
class User {
    var $login;
    var $motDePasse;
    var $nom;
    var $prenom;
    var $email;

    function login() {

    }

    function register() {
        echo $_POST;
    }
}