<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class DataProcessor
class DataProcessor extends DHX {
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
    
    // public action
    public function action(){
        $data = func_get_arg(0);
        $action = $this->data->appendChild(new DOMElement('action'));
        foreach($data as $key => $value){
            if($key == 'details'){
                $action->appendChild($this->document->createTextNode($value));
            }else{
                $action->setAttributeNode(new DOMAttr($key, $value));
            }
        }
    }
    
    // public inserted
    public function inserted($sid, $tid){
        $action = $this->data->appendChild(new DOMElement('action'));
        $action->setAttributeNode(new DOMAttr('type', 'inserted'));
        $action->setAttributeNode(new DOMAttr('sid', $sid));
        $action->setAttributeNode(new DOMAttr('tid', $tid));
        $data = func_get_arg(2);
        if(is_array($data)){
            foreach($data as $key => $value){
                if($key == 'details'){
                    $action->appendChild($this->document->createTextNode($value));
                }else{
                    $action->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public updated
    public function updated($sid, $tid){
        $action = $this->data->appendChild(new DOMElement('action'));
        $action->setAttributeNode(new DOMAttr('type', 'updated'));
        $action->setAttributeNode(new DOMAttr('sid', $sid));
        $action->setAttributeNode(new DOMAttr('tid', $tid));
        $data = func_get_arg(2);
        if(is_array($data)){
            foreach($data as $key => $value){
                if($key == 'details'){
                    $action->appendChild($this->document->createTextNode($value));
                }else{
                    $action->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public deleted
    public function deleted($sid, $tid){
        $action = $this->data->appendChild(new DOMElement('action'));
        $action->setAttributeNode(new DOMAttr('type', 'deleted'));
        $action->setAttributeNode(new DOMAttr('sid', $sid));
        $action->setAttributeNode(new DOMAttr('tid', $tid));
        $data = func_get_arg(2);
        if(is_array($data)){
            foreach($data as $key => $value){
                if($key == 'details'){
                    $action->appendChild($this->document->createTextNode($value));
                }else{
                    $action->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public invalid
    public function invalid($sid, $message){
        $action = $this->data->appendChild(new DOMElement('action'));
        $action->setAttributeNode(new DOMAttr('type', 'invalid'));
        $action->setAttributeNode(new DOMAttr('sid', $sid));
        $action->setAttributeNode(new DOMAttr('message', $message));
        $data = func_get_arg(2);
        if(is_array($data)){
            foreach($data as $key => $value){
                if($key == 'details'){
                    $action->appendChild($this->document->createTextNode($value));
                }else{
                    $action->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public error
    public function error($sid, $tid){
        $action = $this->data->appendChild(new DOMElement('action'));
        $action->setAttributeNode(new DOMAttr('type', 'error'));
        $action->setAttributeNode(new DOMAttr('sid', $sid));
        $action->setAttributeNode(new DOMAttr('tid', $tid));
        $data = func_get_arg(2);
        if(is_array($data)){
            foreach($data as $key => $value){
                if($key == 'details'){
                    $action->appendChild($this->document->createTextNode($value));
                }else{
                    $action->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public result
    public function result(){
        return $this->document->saveXML();
    }
}