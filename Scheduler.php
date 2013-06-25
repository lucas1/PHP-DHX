<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Scheduler
class Scheduler extends DHX {
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
    
    // public event
    public function event(){
        $data = func_get_args();
        foreach($data as $row){
            $event = $this->data->appendChild(new DOMElement('event'));
            foreach($row as $key => $value){
                if($key == 'id'){
                    $event->setAttributeNode(new DOMAttr($key, $value));
                }else{
                    $k = $event->appendChild(new DOMElement($key));
                    $k->appendChild(new DOMCdataSection($value));
                }
            }
        }
    }
    
    // public result
    public function result(){
        return $this->document->saveXML();
    }
}