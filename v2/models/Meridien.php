<?php
class Meridien {
    private $_code;
    private $_nom;
    private $_element;
    private $_yin;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //SETTERS
    public function setCode($code) {
        $this->_code = $code;
    }
    
    public function setNom($nom) {
        $this->_nom = $nom;
    }

    public function setElement($element) {
        $this->_element = $element;
    }

    public function setYin($yin) {
        $this->_yin = $yin;
    }

    //GETTERS
    public function getCode() {
        return $this->_code;
    }

    public function getNom() {
        return $this->_nom;
    }

    public function getElement() {
        return $this->_element;
    }

    public function getYin() {
        return $this->_yin;
    }
}