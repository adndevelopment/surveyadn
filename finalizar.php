<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ("SurveyAd.php");
include ("RespuestaEn.php");

session_start();
echo 'llega aqui';
$surveyAd = new SurveyAd();

$lista = $_SESSION['listaRespuestas'];

$xml='<answers>';
foreach ($lista as $answer) 
    {
        $xml .='<answer>';
        $xml .='<field name="idQuestion">'.$answer->getIdQuestion.'</field>';
        $xml .='<field name="idClient">'.$answer->getIdClient.'</field>';
        $xml .='<field name="comment">'.$answer->getComment.'</field>';
        $xml .='<field name="answerType">'.$answer->getIdTipo.'</field>';
        $xml .='<field name="value">'.$answer->getValue.'</field>';
        $xml .='</answer';
    }
$xml .='</answers>';
$surveyAd->insertAnswer($xml, count($lista));
echo $xml;
?>
