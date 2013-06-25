<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Tabbar
class Tabbar extends DHX {
    private $document; // ref document 
    private $row; // ref row
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $tabbar = $this->document->appendChild(new DOMElement('tabbar'));
        $this->row = $tabbar->appendChild(new DOMElement('row'));
    }
    
    // public tab
    public function tab(){
        $data = func_get_args();
        foreach($data as $row){
            $tab = $this->row->appendChild(new DOMElement('tab'));
            foreach($row as $key => $value){
                if($key == 'text'){
                    $tab->appendChild($this->document->createTextNode($value));
                }elseif($key == 'content'){
                    $content = $tab->appendChild(new DOMElement('content'));
                    $content->appendChild(new DOMCdataSection($value));
                }else{
                    $tab->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        } 
    }
    
    // public result
    public function result(){
        return $this->document->saveXML();
    }
}