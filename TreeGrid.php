<?php
// Lucas Tiago de Moraes

// include class DHX
include_once 'DHX.php';

// class TreeGrid
class TreeGrid extends DHX {
    private $document; // ref document 
    private $rows; // ref rows
    private $array = array(); // array
    private $num = 0;
    public $parent; // set parent
    
    // auto construct
    function __construct($value = ''){
        if($value){
            $this->encoding($value);
        }
        $this->document = $this->document();
        $this->rows = $this->document->appendChild(new DOMElement('rows'));
    }
    
    // public row
    public function row(){
        $data = func_get_args();
        foreach($data as $r){
            $total = count($this->array);
            $row = '';
            if($total > 0){
                $row = $this->array[$this->num]->appendChild(new DOMElement('row'));
            }else{
                $row = $this->rows->appendChild(new DOMElement('row'));
            }
            foreach($r as $key => $value){
                if($key == 'row'){
                    $this->rowArray($row, $value);
                }elseif($key == 'cell'){
                    foreach($value as $r){
                        $cell = $row->appendChild(new DOMElement($key));
                        if(is_array($r)){
                            foreach($r as $k => $v){
                                if($k == 'text'){
                                    $cell->appendChild($this->document->createTextNode($v));
                                }else{
                                    $cell->setAttributeNode(new DOMAttr($k, $v));
                                }
                            }
                        }else{
                            $cell->appendChild($this->document->createTextNode($r));
                        }
                    }
                }else{
                    $row->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // private rowArray
    private function rowArray($ref, $data){
        foreach($data as $r){
            $row = $ref->appendChild(new DOMElement('row'));
            foreach($r as $key => $value){
                if($key == 'row'){
                    $this->rowArray($row, $value);
                }elseif($key == 'cell'){
                    foreach($value as $r){
                        $cell = $row->appendChild(new DOMElement($key));
                        if(is_array($r)){
                            foreach($r as $k => $v){
                                if($k == 'text'){
                                    $cell->appendChild($this->document->createTextNode($v));
                                }else{
                                    $cell->setAttributeNode(new DOMAttr($k, $v));
                                }
                            }
                        }else{
                            $cell->appendChild($this->document->createTextNode($r));
                        }
                    }
                }else{
                    $row->setAttributeNode(new DOMAttr($key, $value));
                }
            }
        }
    }
    
    // public cell
    public function cell(){
        $data = func_get_args();
        $total = count($this->array);
        if($total > 0){
            foreach($data as $row){
                $cell = $this->array[$this->num]->appendChild(new DOMElement('cell'));
                if(is_array($row)){
                    foreach($row as $k => $v){
                        if($k == 'text'){
                            $cell->appendChild($this->document->createTextNode($v));
                        }else{
                            $cell->setAttributeNode(new DOMAttr($k, $v));
                        }
                    }
                }else{
                    $cell->appendChild($this->document->createTextNode($row));
                }
            }
        }   
    }
    
    // public start
    public function start($data){
        $total = count($this->array);
        
        $row = '';
        
        if($total > 0){
            $row = $this->array[$this->num]->appendChild(new DOMElement('row'));
        }else{
            $row = $this->rows->appendChild(new DOMElement('row'));
        }
        
        foreach($data as $key => $value){
            $row->setAttributeNode(new DOMAttr($key, $value));
        }
        
        $this->num++;
        $this->array[$this->num] = $row;
    }
    
    // public end
    public function end(){
        $total = count($this->array);
        unset($this->array[$this->num]);
        $this->num--;
    }
    
    // public result
    public function result(){
        if($this->parent){
            $this->rows->setAttributeNode(new DOMAttr('parent', $this->parent));
        }else{
            $this->rows->setAttributeNode(new DOMAttr('parent', 0));
        }
        return $this->document->saveXML();
    }
}
