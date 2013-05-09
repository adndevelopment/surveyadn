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

$xml = new DOMDocument('1.0','UTF-8');
$root = $xml->createElement('answers');
$root = $xml->appendChild($root);

$client = $xml->createElement('client');
$client = $root->appendChild($client);

$idC = $xml->createElement('field',$clienteEn->getIdClient());
$idC = $idC->setAttribute('name', 'idClient');
$idC = $client->appendChild($idC);

$nameC = $xml->createElement('field',$clienteEn->getName());
$nameC = $nameC->setAttribute('name', 'name');
$nameC = $client->appendChild($nameC);

$emailC = $xml->createElement('field',$clienteEn->getEmail());
$emailC = $emailC->setAttribute('name', 'email');
$emailC = $client->appendChild($emailC);

$telC = $xml->createElement('field',$clienteEn->getTelephone());
$telC = $telC->setAttribute('name', 'telephone');
$telC = $client->appendChild($telC);

$comC = $xml->createElement('field',$clienteEn->getCompania());
$comC = $comC->setAttribute('name', 'compania');
$comC = $client->appendChild($comC);

$apeC = $xml->createElement('field',$clienteEn->getApellidos());
$apeC = $apeC->setAttribute('name', 'apellidos');
$apeC = $client->appendChild($apeC);

$pueC = $xml->createElement('field',$clienteEn->getPuesto());
$pueC = $pueC->setAttribute('name', 'puesto');
$pueC = $client->appendChild($pueC);

$ubiC = $xml->createElement('field',$clienteEn->getUbicacion());
$ubiC = $ubiC->setAttribute('name', 'ubicacion');
$ubiC = $client->appendChild($ubiC);


	$xml->formatOutput = true;

echo '<xmp>'.$xml->saveXML().'</xmp>';
/*
$xml .='<field name="idClient">' . $clienteEn->getIdClient() . '</field>';
$xml .='<field name="name">' . $clienteEn->getName() . '</field>';
$xml .='<field name="email">' . $clienteEn->getEmail() . '</field>';
$xml .='<field name="telephone">' . $clienteEn->getTelephone() . '</field>';
$xml .='<field name="compania">' . $clienteEn->getCompania() . '</field>';
$xml .='<field name="apellidos">' . $clienteEn->getApellidos() . '</field>';
$xml .='<field name="puesto">' . $clienteEn->getPuesto() . '</field>';
$xml .='<field name="ubicacion">' . $clienteEn->getUbicacion() . '</field>';
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

$xmlF = simplexml_load_string($xml);

echo ('<pre>'.$xmlF->asXML().'</pre>');
$surveyAd->insertAnswer($xmlF, count($lista));*/
//echo count($lista);}
}catch (Exception $ex){echo $ex->getMessage();}
session_destroy();
?>
