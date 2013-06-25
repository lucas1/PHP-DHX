<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Tree
class Tree extends DHX {
    private $document; // ref document 
    private $tree; // ref tree
    private $array = array(); // array
    private $num = 0;
    public $id; // set id
    public $radio; // set radio
    public $order; // set order
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->tree = $this->document->appendChild(new DOMElement('tree'));
    }
    
    // public item
    public function item(){
        $data = func_get_args();
        foreach($data as $row){
            $total = count($this->array);
            $item = '';
            if($total > 0){
                $item = $this->array[$this->num]->appendChild(new DOMElement('item'));
            }else{
                $item = $this->tree->appendChild(new DOMElement('item'));
            }
            foreach($row as $key => $value){
                if($key == 'item'){
                    $this->itemArray($item, $value);
                }elseif($key == 'itemtext'){
                    $itemtext = $item->appendChild(new DOMElement($key));
                    $itemtext->appendChild(new DOMCdataSection($value));
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
    
    // private itemArray
    private function itemArray($ref, $data){
        foreach($data as $row){
            $item = $ref->appendChild(new DOMElement('item'));
            foreach($row as $key => $value){
                if($key == 'item'){
                    $this->itemArray($item, $value);
                }elseif($key == 'itemtext'){
                    $itemtext = $item->appendChild(new DOMElement($key));
                    $itemtext->appendChild(new DOMCdataSection($value));
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
    
    // public userdata
    public function userdata(){
        $data = func_get_args();
        foreach($data as $row){
            $total = count($this->array);
            $userdata = '';
            if($total > 0){
                $userdata = $this->array[$this->num]->appendChild(new DOMElement('userdata'));
            }else{
                $userdata = $this->tree->appendChild(new DOMElement('userdata'));
            }
            foreach($row as $key => $value){
                if($key == 'value'){
                    $userdata->appendChild($this->document->createTextNode($value));
                }else{
                    $userdata->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public itemtext
    public function itemtext(){
        $data = func_get_args();
        foreach($data as $row){
            $total = count($this->array);
            $itemtext = '';
            if($total > 0){
                $itemtext = $this->array[$this->num]->appendChild(new DOMElement('itemtext'));
            }else{
                $itemtext = $this->tree->appendChild(new DOMElement('itemtext'));
            }
            $itemtext->appendChild(new DOMCdataSection($row));
        }
    }
    
    public function start($data){
        $total = count($this->array);
        
        $item = '';
        
        if($total > 0){
            $item = $this->array[$this->num]->appendChild(new DOMElement('item'));
        }else{
            $item = $this->tree->appendChild(new DOMElement('item'));
        }
        
        foreach($data as $key => $value){
            $item->setAttributeNode(new DOMAttr($key, $value));
        }
        
        $this->num++;
        $this->array[$this->num] = $item;
    }
    
    public function end(){
        $total = count($this->array);
        unset($this->array[$this->num]);
        $this->num--;
    }
    
    // public result
    public function result(){
        if($this->id){
            $this->tree->setAttributeNode(new DOMAttr('id', $this->id));
        }else{
            $this->tree->setAttributeNode(new DOMAttr('id', 0));
        }
        if($this->radio){
            $this->tree->setAttributeNode(new DOMAttr('radio', $this->radio));
        }
        if($this->order){
            $this->tree->setAttributeNode(new DOMAttr('order', $this->order));
        }
        return $this->document->saveXML();
    }
}
