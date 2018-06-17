<?php
// Insertion d'un champ qcmfait
include '../connexion.php';
session_start();
echo json_encode($_POST);
if ($_POST['idEtudiant'] && $_POST['idQuestionnaire']) {

    // Récupération des QCMs faits
    $res = $db->prepare("DELETE from qcmfait WHERE idEtudiant = " . $_POST['idEtudiant'] . " AND idQuestionnaire = " . $_POST['idQuestionnaire']);
    $count = $res->execute();
    echo json_encode($res);
    print("Effacement de $count lignes.\n");

    $stmt = $db->prepare("INSERT INTO qcmfait (idEtudiant, idQuestionnaire, dateFait, point) VALUES (:idEtudiant, :idQuestionnaire, :dateFait, :point)");
    $stmt->bindParam(':idEtudiant', $_POST['idEtudiant']);
    $stmt->bindParam(':idQuestionnaire', $_POST['idQuestionnaire']);
    $stmt->bindParam(':dateFait', $_POST['dateFait']);
    $stmt->bindParam(':point', $_POST['point']);
    $result = $stmt->execute();
    if($result){
        //What you do here is up to you!
        echo 'Enregistrement effectué';
    } else { echo json_encode($result);}

} else {
    echo 'error idEtudiant';
}