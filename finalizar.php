<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ("SurveyAd.php");
include ("RespuestaEn.php");
include ("ClienteEn.php");

session_start();
try{
$surveyAd = new SurveyAd();

$lista = $_SESSION['listaRespuestas'];
$clienteEn = $_SESSION['cliente'];
$xml = '<answers>';
$xml .='<client>';
$xml .='<field name="idQuestion">' . $clienteEn->getIdClient() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getName() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getApellidos() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getEmail() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getPuesto() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getCompania() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getTelephone() . '</field>';
$xml .='<field name="idQuestion">' . $clienteEn->getUbicacion() . '</field>';
$xml .='</client>';

foreach ($lista as $answer) {
    echo $answer->getIdQuestion();
    $xml .='<answer>';
    $xml .='<field name="idQuestion">' . $answer->getIdQuestion() . '</field>';
    $xml .='<field name="idClient">' . $answer->getIdClient() . '</field>';
    $xml .='<field name="comment">' . $answer->getComment() . '</field>';
    $xml .='<field name="answerType">' . $answer->getIdTipo() . '</field>';
    $xml .='<field name="value">' . $answer->getValue() . '</field>';
    $xml .='</answer>';
}
$xml .='</answers>';

printf($xml);
$surveyAd->insertAnswer($xml, count($lista));
echo count($lista);}
 catch (Exception $ex){echo $ex->getMessage();}
?>
