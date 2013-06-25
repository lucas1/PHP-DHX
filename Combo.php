<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Combo
class Combo extends DHX {
    private $document; // ref document 
    private $complete; // ref complete
    public $add; // set add
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->complete = $this->document->appendChild(new DOMElement('complete'));
    }
    
    // public option
    public function option(){
        $data = func_get_args();
        foreach($data as $row){
            $option = $this->complete->appendChild(new DOMElement('option'));
            foreach($row as $key => $value){
                if($key == 'text'){
                    $option->appendChild($this->document->createTextNode($value));
                }elseif($key == 'cdata'){
                    $option->appendChild(new DOMCdataSection($value));
                }else{
                    $option->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public result
    public function result(){
        if($this->add){
            $this->complete->setAttributeNode(new DOMAttr('add', $this->add));
        }
        return $this->document->saveXML();
    }
}