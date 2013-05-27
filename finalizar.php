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
$idCAtt->value='idClient';
$idC->appendChild($idCAtt);
$idCText = $xml->createTextNode($clienteEn->getIdClient());//$idC->setAttribute('name', 'idClient');
$idC->appendChild($idCText); 
$client->appendChild($idC);

$nameC = $xml->createElement('field');
$nameCAtt = $xml->createAttribute('name');
$nameCAtt->value='name';
$nameC->appendChild($nameCAtt);
$nameCText = $xml->createTextNode($clienteEn->getName());// = $nameC->setAttribute('name', 'name
$nameC->appendChild($nameCText); 
$client->appendChild($nameC);

$emailC = $xml->createElement('field');
$emailCAtt = $xml->createAttribute('name');
$emailCAtt->value='email';
$emailC->appendChild($emailCAtt);
$emailCText = $xml->createTextNode($clienteEn->getEmail());// = $emailC->setAttribute('name', 'email');
$emailC->appendChild($emailCText); 
$client->appendChild($emailC);

$telC = $xml->createElement('field');
$telCAtt = $xml->createAttribute('name');
$telCAtt->value='telephone';
$telC->appendChild($telCAtt);
$telCText = $xml->createTextNode($clienteEn->getTelephone());// = $telC->setAttribute('name', 'telephone');
$telC->appendChild($telCText); 
$client->appendChild($telC);

$comC = $xml->createElement('field');
$comCAtt = $xml->createAttribute('name');
$comCAtt->value='compania';
$comC->appendChild($comCAtt);
$comCText = $xml->createTextNode($clienteEn->getCompania());// = $comC->setAttribute('name', 'compania');
$comC->appendChild($comCText); 
$client->appendChild($comC);

$apeC = $xml->createElement('field');
$apeCAtt = $xml->createAttribute('name');
$apeCAtt->value='apellidos';
$apeC->appendChild($apeCAtt);
$apeCText = $xml->createTextNode($clienteEn->getApellidos());// = $apeC->setAttribute('name', 'apellidos');
$apeC->appendChild($apeCText); 
$client->appendChild($apeC);

$pueC = $xml->createElement('field');
$pueCAtt = $xml->createAttribute('name');
$pueCAtt->value='puesto';
$pueC->appendChild($pueCAtt);
$pueCText = $xml->createTextNode($clienteEn->getPuesto());// = $pueC->setAttribute('name', 'puesto');
$pueC->appendChild($pueCText); 
$client->appendChild($pueC);

$ubiC = $xml->createElement("field");
$ubiCAtt = $xml->createAttribute('name');
$ubiCAtt->value='ubicacion';
$ubiC->appendChild($ubiCAtt);
$ubiCText = $xml->createTextNode($clienteEn->getUbicacion());// = $ubiC->setAttribute('name', 'ubicacion');
$ubiC->appendChild($ubiCText); 
$client->appendChild($ubiC);

$root->appendChild($client);


	


foreach ($lista as $answer) {
    
    $answerX = $xml->createElement('answer');
    
    $idQ = $xml->createElement('field',$answer->getIdQuestion());
    $idQAtt = $xml->createAttribute('name');
    $idQAtt->value='idQuestion';
    $idQ->appendChild($idQAtt);
    $answerX->appendChild($idQ);
    
    $idCQ = $xml->createElement('field',$answer->getIdClient());
    $idCQAtt = $xml->createAttribute('name');
    $idCQAtt->value='idClient';
    $idCQ->appendChild($idCQAtt);
    $answerX->appendChild($idCQ);
    
    if($answer->getIdTipo()=='comment')
    {$commQ = $xml->createElement('field',$answer->getValue());}else
    {$commQ = $xml->createElement('field',$answer->getComment());}
    
    $commQAtt = $xml->createAttribute('name');
    $commQAtt->value='comment';
    $commQ->appendChild($commQAtt);
    $answerX->appendChild($commQ);
    
    $tipQ = $xml->createElement('field',$answer->getIdTipo());
    $tipQAtt = $xml->createAttribute('name');
    $tipQAtt->value='answerType';
    $tipQ->appendChild($tipQAtt);
    $answerX->appendChild($tipQ);
    
    
    
    
    $valQ = $xml->createElement('field',$answer->getValue());
    $valQAtt = $xml->createAttribute('name');
    $valQAtt->value='value';
    $valQ->appendChild($valQAtt);
    $answerX->appendChild($valQ);

   $root->appendChild($answerX);
    
}
$xml->formatOutput = true;


$xmlF =$xml->saveXML();

$surveyAd->insertAnswer($xmlF, count($lista));


}catch (Exception $ex){echo $ex->getMessage();}
session_destroy();

echo '<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/cssSurvey.css" rel="stylesheet" type="text/css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

        <title>Gracias</title>
        <script>
            $(document).ready(function()
            {
                $("div:hidden").fadeIn(2000);
                $("img").click(function(){
                  $("div").fadeOut("slow",function(){window.location="http://www.data.cr"});  
                });
            });
            
        </script>
    </head>
    <body>
    
    <center>
    <div>
    <img src="img/agradecimiento.jpg" alt="American Data Networks"/>
    </div>
    </center>

    </body>';

?>
