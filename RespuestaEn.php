<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespuestaEn
 *
 * @author godie44
 */
class RespuestaEn {
private $idQuestion;
private $idClient;
private $comment;
private $idTipo;
private $value;

public function getIdQuestion() {
    return $this->idQuestion;
}

public function setIdQuestion($idQuestion) {
    $this->idQuestion = $idQuestion;
}

public function getIdClient() {
    return $this->idClient;
}

public function setIdClient($idClient) {
    $this->idClient = $idClient;
}

public function getComment() {
    return $this->comment;
}

public function setComment($comment) {
    $this->comment = $comment;
}

public function getIdTipo() {
    return $this->idTipo;
}

public function setIdTipo($idTipo) {
    $this->idTipo = $idTipo;
}

public function getValue() {
    return $this->value;
}

public function setValue($value) {
    $this->value = $value;
}



}

?>
