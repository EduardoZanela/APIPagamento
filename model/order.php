<?php
class OrderModel{
    private $id;
    private $comprador;
    private $valorComprado;
    private $paymentMethod;
    private $idmetodo;

    //Metodos magicos para atribuir/buscar propriedades
    public function __construct() {}

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
}