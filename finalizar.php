<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
echo 'llega aqui';
$lista = $_SESSION['listaRespuestas'];

$xml='<answers>';
foreach ($lista as $answer) 
    {
        $xml .='<answer>';
        $xml .='<field name="idQuestion">'.$answer->idQuestion.'</field>';
        $xml .='<field name="idClient">'.$answer->idClient.'</field>';
        $xml .='<field name="comment">'.$answer->comment.'</field>';
        $xml .='<field name="answerType">'.$answer->idTipo.'</field>';
        $xml .='<field name="value">'.$answer->value.'</field>';
        $xml .='</answer';
    }
$xml .='</answers>';

echo $xml;
?>
