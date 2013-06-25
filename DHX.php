<?php
// Lucas Tiago de Moraes

function class_dhx_autoload ($class) {
    include(__DIR__ . "/" . $class . ".php");
}
spl_autoload_register("class_dhx_autoload");

// classe DHX
class DHX {
    // encoding
    private $encoding = 'utf-8';
    
    public function encoding($value){
        $this->encoding = $value;
    }
    
    // protected document
    protected function document(){
        $doc = new DOMDocument('1.0', $this->encoding);
        return $doc;
    }
    
    // public header
    public function header(){
        header("Content-type: application/xml; charset=".$this->encoding);
    }
}