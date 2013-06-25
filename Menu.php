<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Menu
class Menu extends DHX {
    private $document; // ref document 
    private $menu; // ref menu
    private $array = array(); // array
    private $num = 0;
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->menu = $this->document->appendChild(new DOMElement('menu'));
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
                $item = $this->menu->appendChild(new DOMElement('item'));
            }
            foreach($row as $key => $value){
                if($key == 'item'){
                    $this->itemArray($item, $value);
                }elseif($key == 'hotkey'){
                    $hotkey = $item->appendChild(new DOMElement('hotkey'));
                    $hotkey->appendChild($this->document->createTextNode($value));
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
                }elseif($key == 'hotkey'){
                    $hotkey = $item->appendChild(new DOMElement('hotkey'));
                    $hotkey->appendChild($this->document->createTextNode($value));
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
                $userdata = $this->menu->appendChild(new DOMElement('userdata'));
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
    
    // public start
    public function start($data){
        $total = count($this->array);
        
        $item = '';
        
        if($total > 0){
            $item = $this->array[$this->num]->appendChild(new DOMElement('item'));
        }else{
            $item = $this->menu->appendChild(new DOMElement('item'));
        }
        
        foreach($data as $key => $value){
            $item->setAttributeNode(new DOMAttr($key, $value));
        }
        
        $this->num++;
        $this->array[$this->num] = $item;
    }
    
    // public end
    public function end(){
        $total = count($this->array);
        unset($this->array[$this->num]);
        $this->num--;
    }
    
    // public result
    public function result(){
        return $this->document->saveXML();
    }
}