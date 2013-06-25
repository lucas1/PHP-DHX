<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class DataView
class DataView extends DHX {
    private $document; // ref document 
    private $data; // ref data
    public $pos; // set pos
    public $total_count; // set total_count
    
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
                    $k->appendChild(new DOMCdataSection($value));
                }
            }
        }
    }
    
    // public file
    public function file(){
        $data = func_get_args();
        foreach($data as $row){
            $item = $this->data->appendChild(new DOMElement('item'));
            foreach($row as $key => $value){
                if($key == 'filesize' || $key == 'modifdate'){
                    $k = $item->appendChild(new DOMElement($key));
                    $k->appendChild($this->document->createTextNode($value));                   
                }else{
                    $item->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public result
    public function result(){
        if($this->pos){
            $this->data->setAttributeNode(new DOMAttr('pos', $this->pos));
        }
        if($this->total_count){
            $this->data->setAttributeNode(new DOMAttr('total_count', $this->total_count));
        }
        return $this->document->saveXML();
    }
}