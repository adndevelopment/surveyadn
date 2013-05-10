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


$idC = $xml->createElement('field');
$idCAtt = $xml->createAttribute('name');

$idCText = $xml->createTextNode($clienteEn->getIdClient());//$idC->setAttribute('name', 'idClient');
$idC->appendChild($idCText); 
$client->appendChild($idC);

$nameC = $xml->createElement('field');
$nameCText = $xml->createTextNode($clienteEn->getName());// = $nameC->setAttribute('name', 'name
$nameC->appendChild($nameCText); 
$client->appendChild($nameC);

$emailC = $xml->createElement('field');
$emailCText = $xml->createTextNode($clienteEn->getEmail());// = $emailC->setAttribute('name', 'email');
$emailC->appendChild($emailCText); 
$client->appendChild($emailC);

$telC = $xml->createElement('field');
$telCText = $xml->createTextNode($clienteEn->getTelephone());// = $telC->setAttribute('name', 'telephone');
$telC->appendChild($telCText); 
$client->appendChild($telC);

$comC = $xml->createElement('field');
$comCText = $xml->createTextNode($clienteEn->getCompania());// = $comC->setAttribute('name', 'compania');
$comC->appendChild($comCText); 
$client->appendChild($comC);

$apeC = $xml->createElement('field');
$apeCText = $xml->createTextNode($clienteEn->getApellidos());// = $apeC->setAttribute('name', 'apellidos');
$apeC->appendChild($apeCText); 
$client->appendChild($apeC);

$pueC = $xml->createElement('field');
$pueCText = $xml->createTextNode($clienteEn->getPuesto());// = $pueC->setAttribute('name', 'puesto');
$pueC->appendChild($pueCText); 
$client->appendChild($pueC);

$ubiC = $xml->createElement("field");
$ubiCText = $xml->createTextNode($clienteEn->getUbicacion());// = $ubiC->setAttribute('name', 'ubicacion');
$ubiC->appendChild($ubiCText); 
$client->appendChild($ubiC);

$root->appendChild($client);


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
