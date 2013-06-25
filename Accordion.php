<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Accordion
class Accordion extends DHX {
    public $skin = 'dhx_skyblue'; // set skin
    public $mode = 'single'; // set mode
    public $iconsPath = '../common/'; // set iconsPath
    public $openEffect = 'false'; // set openEffect
    private $document; // ref document 
    private $accordion; // ref accordion
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->accordion = $this->document->appendChild(new DOMElement('accordion'));
    }
    
    // public cell
    public function cell(){
        $data = func_get_args();
        foreach($data as $row){
            $cell = $this->accordion->appendChild(new DOMElement('cell'));
            foreach($row as $key => $value){
                if($key == 'text'){
                    $cell->appendChild($this->document->createTextNode($value));
                }else{
                    $cell->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        } 
    }
    
    // public result
    public function result(){
        $this->accordion->setAttributeNode(new DOMAttr('skin', $this->skin));
        $this->accordion->setAttributeNode(new DOMAttr('mode', $this->mode));
        $this->accordion->setAttributeNode(new DOMAttr('iconsPath', $this->iconsPath));
        $this->accordion->setAttributeNode(new DOMAttr('openEffect', $this->openEffect));
        return $this->document->saveXML();
    }
}