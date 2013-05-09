<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteEn
 *
 * @author godie44
 */
class ClienteEn {
private $idClient;
private $name;
private $email;
private $telephone;
private $compania;
private $apellidos;
private $puesto;
private $ubicacion;

public function getIdClient() {
    return $this->idClient;
}

public function setIdClient($idClient) {
    $this->idClient = $idClient;
}

public function getName() {
    return $this->name;
}

public function setName($name) {
    $this->name = $name;
}

public function getEmail() {
    return $this->email;
}

public function setEmail($email) {
    $this->email = $email;
}

public function getTelephone() {
    return $this->telephone;
}

public function setTelephone($telephone) {
    $this->telephone = $telephone;
}

public function getCompania() {
    return $this->compania;
}

public function setCompania($compania) {
    $this->compania = $compania;
}

public function getApellidos() {
    return $this->apellidos;
}

public function setApellidos($apellidos) {
    $this->apellidos = $apellidos;
}

public function getPuesto() {
    return $this->puesto;
}

public function setPuesto($puesto) {
    $this->puesto = $puesto;
}

public function getUbicacion() {
    return $this->ubicacion;
}

public function setUbicacion($ubicacion) {
    $this->ubicacion = $ubicacion;
}


}

?>
