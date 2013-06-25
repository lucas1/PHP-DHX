<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Chart
class Chart extends DHX {
    private $document; // ref document 
    private $data; // ref data
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->data = $this->document->appendChild(new DOMElement('data'));
    }
    
    // public item
    public function item(){
        $data = func_get_args();
        foreach($data as $row){
            $item = $this->data->appendChild(new DOMElement('item'));
            foreach($row as $key => $value){
                if($key == 'id'){
                    $item->setAttributeNode(new DOMAttr($key, $value));
                }else{
                    $k = $item->appendChild(new DOMElement($key));
                    $k->appendChild($this->document->createTextNode($value));
                }
            }
        }
    }
    
    // public result
    public function result(){
        return $this->document->saveXML();
    }
}