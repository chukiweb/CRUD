<?php

/*
 * I.E.S Aguadulce Curso 2019/2020.
 * Grado Superior De Desarollo De Aplicaciones Web Modalidad A Distancia.
 * Módulo de Programación.
 * Profesor: Narciso Jáimez Toro.
 * Alumno: Eduardo Nicolás Araoz Demarchi.
 * Email: chukiweb@gmail.com.
 */

/**
 * Description of Producto
 *
 * @author nicolas
 */
class Producto {
    
    
    protected $codigo;
    protected $nombre;
    protected $precio;
    protected $concepto;
    protected $stock;
    protected  $familia;

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getConcepto() {
        return $this->concepto;
    }

    function getStock() {
        return $this->stock;
    }

    function getFamilia() {
        return $this->familia;
    }

    
    public function __construct($array) {
        $this->codigo = $array['codigoMov'];
        $this->nombre = $array['loginUsu'];
        $this->fecha = $array['fecha'];
        $this->concepto = $array['concepto'];
        $this->cantidad = $array['cantidad'];
    }

}
