<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class Form
class Form extends DHX {
    private $document; // ref document 
    private $items; // ref items
    private $array = array(); // array
    private $num = 0;
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->items = $this->document->appendChild(new DOMElement('items'));
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
                $item = $this->items->appendChild(new DOMElement('item'));
            }
            foreach($row as $key => $value){
                if($key == 'item'){
                    $this->itemArray($item, $value);
                }elseif($key == 'note'){
                    $note = $item->appendChild(new DOMElement('note'));
                    if(is_array($value)){
                        foreach($value as $k => $v){
                            if($k == 'text'){
                                $note->appendChild($this->document->createTextNode($v));
                            }else{
                                $note->setAttributeNode(new DOMAttr($k, $v));
                            }
                        }
                    }else{
                        $note->appendChild($this->document->createTextNode($v));
                    }
                }elseif($key == 'option'){
                    foreach($value as $r){
                        $option = $item->appendChild(new DOMElement('option'));
                        foreach($r as $k => $v){
                            $option->setAttributeNode(new DOMAttr($k, $v));
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
                }elseif($key == 'note'){
                    $note = $item->appendChild(new DOMElement('note'));
                    if(is_array($value)){
                        foreach($value as $k => $v){
                            if($k == 'text'){
                                $note->appendChild($this->document->createTextNode($v));
                            }else{
                                $note->setAttributeNode(new DOMAttr($k, $v));
                            }
                        }
                    }else{
                        $note->appendChild($this->document->createTextNode($v));
                    }
                }elseif($key == 'option'){
                    foreach($value as $r){
                        $option = $item->appendChild(new DOMElement('option'));
                        foreach($r as $k => $v){
                            $option->setAttributeNode(new DOMAttr($k, $v));
                        }
                    }
                }else{
                    $item->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public option
    public function option(){
        $data = func_get_args();
        foreach($data as $row){
            $total = count($this->array);
            $option = '';
            if($total > 0){
                $option = $this->array[$this->num]->appendChild(new DOMElement('option'));
            }else{
                $option = $this->items->appendChild(new DOMElement('option'));
            }
            foreach($row as $key => $value){
                $option->setAttributeNode(new DOMAttr($key, $value));
            }
        }
    }
    
    public function start($data){
        $total = count($this->array);
        
        $item = '';
        
        if($total > 0){
            $item = $this->array[$this->num]->appendChild(new DOMElement('item'));
        }else{
            $item = $this->items->appendChild(new DOMElement('item'));
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
        return $this->document->saveXML();
    }
}