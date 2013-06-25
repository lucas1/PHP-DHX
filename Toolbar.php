<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Toolbar
class Toolbar extends DHX {
    private $document; // ref document 
    private $toolbar; // ref toolbar
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->toolbar = $this->document->appendChild(new DOMElement('toolbar'));
    }
    
    // public item
    public function item(){
        $data = func_get_args();
        foreach($data as $row){
            $item = $this->toolbar->appendChild(new DOMElement('item'));
            foreach($row as $key => $value){
                if($key == 'item'){
                    if(array_key_exists(0, $value)){
                        foreach($value as $r){
                            $i = $item->appendChild(new DOMElement('item'));
                            foreach($r as $k => $v){
                                $i->setAttributeNode(new DOMAttr($k, $v));
                            }
                        }
                    }else{
                        $i = $item->appendChild(new DOMElement('item'));
                        foreach($value as $k => $v){
                            $i->setAttributeNode(new DOMAttr($k, $v));
                        }
                    }
                }elseif($key == 'userdata'){
                    if(array_key_exists(0, $value)){
                        foreach($value as $r){
                            $userdata = $item->appendChild(new DOMElement('userdata'));
                            foreach($r as $k => $v){
                                if($k == 'value'){
                                    $userdata->appendChild($this->document->createTextNode($v));
                                }else{
                                    $userdata->setAttributeNode(new DOMAttr($k, $v));
                                }
                            }
                        }
                    }else{
                        $userdata = $item->appendChild(new DOMElement('userdata'));
                        foreach($value as $k => $v){
                            if($k == 'value'){
                                $userdata->appendChild($this->document->createTextNode($v));
                            }else{
                                $userdata->setAttributeNode(new DOMAttr($k, $v));
                            }
                        }
                    }
                }else{
                    $item->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        } 
    }
    
    // public result
    public function result(){
        return $this->document->saveXML();
    }
}