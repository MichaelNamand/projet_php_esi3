<?php

include '../connexion.php';
session_start();
// Récupération des QCMs
$res = $db->prepare("SELECT * from questionnaire");
$res->execute();
$questionnaires = array();
while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) {
    $questionnaires[] = array_map("utf8_encode", $ligne);
}

// Récupération des QCMs faits
$res = $db->prepare("SELECT * from qcmfait");
$res->execute();
$QCMFaits = array();
while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) {
    $QCMFaits[] = array_map("utf8_encode", $ligne);
}


$results = array();
foreach ($questionnaires as $key => $questionnaire) {
    foreach ($QCMFaits as $QCMFait) {
        if ($QCMFait['idQuestionnaire'] == $questionnaire['idQuestionnaire'] && $QCMFait['idEtudiant'] == $_SESSION['user']['idEtudiant']){
            $questionnaires[$key]['date_done'] = $QCMFait['dateFait'];
            $questionnaires[$key]['point'] = $QCMFait['point'];
        }
    }

    // Récupération des questions questionnaire
    $questions = array();
    $res = $db->prepare("SELECT * from questionquestionnaire WHERE idQuestionnaire = " . $questionnaire['idQuestionnaire']);
    $res->execute();
    while ($questionsQuestionnaires = $res->fetch(PDO::FETCH_ASSOC)) {
        // Récupération des questions
        $res2 = $db->prepare("SELECT * from question WHERE idQuestion = " . $questionsQuestionnaires['idQuestion']);
        $res2->execute();
        while ($questionsBDD = $res2->fetch(PDO::FETCH_ASSOC)) {
            // Récupération des réponses
            $res3 = $db->prepare("SELECT * from questionreponse WHERE idQuestion = " . $questionsBDD['idQuestion']);
            $res3->execute();
            while ($questionsReponses = $res3->fetch(PDO::FETCH_ASSOC)) {

                $res4 = $db->prepare("SELECT * from reponse WHERE idReponse = " . $questionsReponses['idReponse']);
                $res4->execute();
                while ($reponsesBDD = $res4->fetch(PDO::FETCH_ASSOC)) {
                    $reponsesBDD['bonne'] = $questionsReponses['bonne'];
                    $reponses[] = array_map("utf8_encode", $reponsesBDD);
                }

                $questionsBDD['reponses'] = json_encode($reponses);
            }

            $reponses = array();
            $questions[] = array_map("utf8_encode", $questionsBDD);
        }
    }

    $questionnaires[$key]['questions'] = $questions;



}
echo json_encode($questionnaires);
?>